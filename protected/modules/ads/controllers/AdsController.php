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

		$this->pageTitle = $ads->title;
		$this->render('view', array(
			'ads' => $ads,
		));
	}
}