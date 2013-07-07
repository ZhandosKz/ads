<?php
class AdsUrlRule extends CBaseUrlRule
{
	public $connectionID = 'db';

	public function createUrl($manager,$route,$params,$ampersand)
	{
		if ($route==='ads/ads/view')
		{
			if (isset($params['alias']))
			{
				$url = 'ads/'.$params['alias'];
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
		if (preg_match('/^(ads\/)([a-z0-9-]+)$/', $pathInfo, $matches))
		{
			Yii::import('application.modules.admin.models.Ads');
			$ads = Ads::model()->find('alias = :alias', array(':alias' => $matches[2]));
			if (!$ads instanceof Ads)
			{
				return FALSE;
			}

			$_GET['alias'] = $ads->alias;
			return 'ads/ads/view';
		}
		return false;
	}
}