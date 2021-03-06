<?php
class CategoryUrlRule extends CBaseUrlRule
{
	public $connectionID = 'db';

	public function createUrl($manager,$route,$params,$ampersand)
	{
		if ($route==='ads/category/view')
		{
			if (isset($params['alias']))
			{
				$url = 'ads/category/'.$params['alias'];
				unset($params['alias']);
				if (!empty($params))
				{
					$url .= '?'.implode('&', array_map(function($key, $value){
							return $key.'='.$value;
						}, array_keys($params), array_values($params)));
				}
				return $url;
			}
		}
		return false;
	}

	public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
	{
		if (preg_match('/^(ads\/category\/)([a-z0-9-]+)$/', $pathInfo, $matches))
		{
			Yii::import('application.modules.admin.models.Category');
			$category = Category::model()->find('alias = :alias', array(':alias' => $matches[2]));
			if (!$category instanceof Category)
			{
				return FALSE;
			}

			$_GET['alias'] = $category->alias;
			return 'ads/category/view';
		}
		return false;
	}
}