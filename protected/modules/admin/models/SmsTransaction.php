<?php

/**
 * This is the model class for table "sms_transaction".
 *
 * The followings are the available columns in table 'sms_transaction':
 * @property integer $id
 * @property string $phone
 * @property string $code
 * @property integer $status
 * @property string $user_cookie
 */
class SmsTransaction extends CActiveRecord
{
	const STATUS_OPEN = 0;
	const STATUS_CLOSE = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SmsTransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sms_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('phone, code', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, phone, code, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'phone' => 'Phone',
			'code' => 'Code',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function open($phone)
	{
		$this->phone = $phone;
		$this->code = $this->getNewCode();
		$this->status = self::STATUS_OPEN;
		$this->user_cookie = User::getUserCookie();
		if (!$this->putSms() || !$this->save())
		{

			return FALSE;
		}

		return TRUE;
	}

	public function close()
	{
		$this->status = self::STATUS_CLOSE;
		$this->save();
	}


	/**
	 * Метод заглушка, имитурует отправку смс через стороннее API
	 * @param $phone
	 * @return bool
	 */
	public function putSms()
	{
		if (empty($this->phone))
		{
			throw new CException('Ошибка отправки СМС', E_USER_ERROR);
		}
		return TRUE;
	}

	public function getNewCode()
	{
		return User::getSalt(6);
	}
}