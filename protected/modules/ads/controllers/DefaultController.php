<?php
class DefaultController extends ModuleController
{
	public $layout = '//layouts/main';
    public function actionIndex()
    {

        //$this->redirect('/admin/content');
        $this->render('index');
    }
}