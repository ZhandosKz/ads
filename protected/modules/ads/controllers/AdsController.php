<?php
class AdsController extends ModuleController
{
	public function actionIndex()
	{
		$this->redirect('/ads/categories');
	}

	public function actionView($alias)
	{
		$ads = Ads::model()->find('alias = :alias', array(':alias' => $alias));

		if (!$ads instanceof Ads)
		{
			throw new CHttpException(404, 'Объявление не найдено');
		}


		ContentView::setView($ads);

		$this->pageTitle = $ads->title;
		$this->render('view', array(
			'ads' => $ads,
		));
	}

	public function actionPublish()
	{
		$this->layout = '//layouts/main';
		$model = new PublishAdsForm();

		if (Yii::app()->user->isGuest)
		{
			$model->setScenario('guest');
		}

		$request = Yii::app()->request;

		if ($request->isAjaxRequest)
		{

			if (MyArray::checkValue($_POST, 'ajax', PublishAdsForm::FORM_ID))
			{
				echo CActiveForm::validate($model);
			}

			if (MyArray::checkValue($_POST, 'ajax', 'get_sms_code'))
			{
				$smsTransaction = new SmsTransaction();
				$smsTransaction->open($_POST['phone']);
			}

			Yii::app()->end();
		}

		if ($request->isPostRequest)
		{
			if (($result = $model->createAds($request->getPost(get_class($model)))) !== FALSE)
			{
				FlashMessage::setSuccess('Объявление опубликовано');
				$this->redirect(array('/ads/ads/view', 'alias' => $result->alias));
			}
		}

		$this->pageTitle = 'Публикация объявления';
		$this->render('publish', array(
			'model' => $model
		));
	}
}