<?php
class ModuleController extends Controller
{
    public  $leftMenu = array();
	public $layout = '//layouts/admin';
    protected function beforeAction($action)
    {
        $this->breadcrumbs = array(
            'Админ.панель' => '/admin'
        );
        return parent::beforeAction($action);
    }
    public function filters()
    {
        return array('accessControl');
    }
    public function accessRules()
    {
        return array(
	        array(
	            'allow',
		        'roles' => array('superadmin')
	        ),
	        array(
		        'deny',
	        ),
        );
    }
}