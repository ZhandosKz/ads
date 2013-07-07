<?php

class PublishAdsForm extends CFormModel
{
	public $title;
	public $categories;
	public $description;

	public $phone;
	public $email;

	public $smsCode;

	const FORM_ID = 'ads_publish_form';

	/**
	 * @var SmsTransaction
	 */
	private $_smsTransaction;

	public function rules()
	{
		return array(
			array('title, categories, description, phone, smsCode', 'required'),
			array('email', 'email'),
			array('email', 'required', 'on' => 'guest'),
			array('email', 'unique', 'className' => 'User',  'on' => 'guest'),
			array('smsCode', 'validateCode')
		);
	}

	public function validateCode()
	{
		$this->_smsTransaction = SmsTransaction::model()->find('phone = :phone AND session_id = :session_id AND code = :code', array(
			':phone' => $this->phone,
			':session_id' => session_id(),
			':code' => $this->smsCode
		));

		if (!$this->_smsTransaction instanceof SmsTransaction)
		{
			$this->addError('smsCode', 'Код не верен');
		}
	}
	public function attributeLabels()
	{
		return array(
			'title' => Ads::model()->getAttributeLabel('title'),
			'description' => Ads::model()->getAttributeLabel('description'),
			'categories' => Ads::model()->getAttributeLabel('categories'),
			'email' => 'Контактный email',
			'phone' => 'Контактный телефон'
		);
	}

	/**
	 * @param array $data
	 * @return Ads|bool
	 * @throws CException
	 */
	public function createAds(Array $data)
	{
		$this->setAttributes($data);
		if (!$this->validate())
		{
			return FALSE;
		}

		if (Yii::app()->user->isGuest)
		{
			$randomPassword = User::getRandomPassword();

			$user = new User('newPassword');
			$user->email = $this->email;
			$user->username = $this->email;
			$user->password = $randomPassword;
			if (!$user->save())
			{
				throw new CException('Ошибка создания пользователя', E_USER_ERROR);
			}

			$loginForm = new LoginForm();
			$loginForm->setAttributes(array(
				'username' => $user->username,
				'password' => $randomPassword
			));

			if (!$loginForm->validate() || !$loginForm->login())
			{
				throw new CException('Ошибка авторизации созданного пользователя', E_USER_ERROR);
			}

		}

		$ads = new Ads();

		$ads->categories = $this->categories;
		$ads->title = $this->title;
		$ads->description = $this->description;
		$ads->user_id = Yii::app()->user->id;
		$ads->is_published = 1;

		if (!$ads->save())
		{
			throw new CException('Ошибка публикации объявления', E_USER_ERROR);
		}

		$this->_smsTransaction->close();

		return $ads;
	}


}