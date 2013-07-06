<?php

class CategoryController extends ModuleController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->pageTitle = 'Просмотр категории';
		$this->render('view',array(
			'data'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Category;

		$request = Yii::app()->request;

		$this->performAjaxValidation($request, $model);

		if ($request->isPostRequest)
		{
			$model->attributes = $request->getPost(get_class($model));
			if($model->save())
			{
				FlashMessage::setSuccess('Категория создана');
				$this->redirect(array('index'));
			}

		}
		$this->pageTitle = 'Создание категории';
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$request = Yii::app()->request;

		$this->performAjaxValidation($request, $model);

		if ($request->isPostRequest)
		{
			$model->attributes = $request->getPost(get_class($model));
			if($model->save())
			{
				FlashMessage::setSuccess('Категория отредактирована');
				$this->redirect(array('index'));
			}

		}

		$this->pageTitle = 'Редактирование категории';
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Category('search');

		if (Yii::app()->getRequest()->isAjaxRequest)
		{
			header( 'Content-type: application/json');
			echo $this->renderPartial('index',array(
				'model'=> $model,
			));
			Yii::app()->end();
		}

		$this->pageTitle = 'Управление категориями';
		$this->render('index',array(
			'model'=>$model,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation(CHttpRequest $request, CActiveRecord $model)
	{
		if($request->isAjaxRequest && MyArray::checkValue($_POST, 'ajax', 'category_form'))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
