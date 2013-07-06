<?php
class CategoryUrlRule extends CBaseUrlRule
{
	public $connectionID = 'db';

	public function createUrl($manager,$route,$params,$ampersand)
	{

		return false;  // не применяем данное правило
	}

	public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
	{

		return false;  // не применяем данное правило
	}
}