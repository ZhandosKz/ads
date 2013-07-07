<?php
class AliasBehavior extends CActiveRecordBehavior
{
	public $toAliasAttribute;

	public  function beforeSave($event)
	{
		if (!empty($this->toAliasAttribute) && $this->owner->hasAttribute('alias'))
		{
			$this->owner->alias = Transliterate::getUrl($this->owner->{$this->toAliasAttribute});
		}
}
}