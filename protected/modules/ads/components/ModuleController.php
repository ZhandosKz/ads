<?php
class ModuleController extends Controller
{
    public  $leftMenu = array();
	public $layout = '//layouts/ads';
    protected function beforeAction($action)
    {
        $this->breadcrumbs = array(
            Yii::t('ads', 'Доска объявлений') => '/ads'
        );
        return parent::beforeAction($action);
    }
}