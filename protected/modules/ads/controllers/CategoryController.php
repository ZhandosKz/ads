<?php
class CategoryController extends ModuleController
{
	public function actionIndex()
	{
		$categories = Category::model()->findAll();

		$this->render('index', array(
			'categories' => $categories
		));
	}
}