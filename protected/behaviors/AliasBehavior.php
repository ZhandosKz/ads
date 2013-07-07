<?php
class AliasBehavior extends CActiveRecordBehavior
{
	public $toAliasAttribute;

	public  function beforeSave($event)
	{
		if (!empty($this->toAliasAttribute) && $this->owner->hasAttribute('alias'))
		{
			$this->owner->alias = Transliterate::getUrl($this->owner->{$this->toAliasAttribute});

			$className = get_class($this->owner);

			$uniquePostfix = 0;
			$alias = $this->owner->alias;

			while ($className::model()->find('alias = :alias', array(':alias' => $this->owner->alias)) instanceof $className)
			{
				$uniquePostfix ++;
				$this->owner->alias = $alias.'-'.$uniquePostfix;
			}

		}
}
}