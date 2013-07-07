<?php
class CategoryController extends ModuleController
{
	public function actionIndex()
	{
		$this->pageTitle = 'Все объявления';
		$this->render('index', array(
			'adsDataProvider' => Ads::getCListDataProvider()
		));
	}

	public function actionView($alias)
	{
		$category = Category::model()->find('alias = :alias', array(':alias' => $alias));
		if (!$category instanceof Category)
		{
			throw new CHttpException(404, 'Категория не найдена');
		}

		$this->pageTitle = $category->name;
		$this->render('view', array(
			'category' => $category,
			'dataProvider' => Ads::getCListDataProvider($category->getPrimaryKey())
		));
	}
}