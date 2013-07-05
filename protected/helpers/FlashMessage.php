<?php
class FlashMessage
{
	const SUCCESS = 0;
	const ERROR = 1;
	const WARNING = 2;

	public static function setSuccess($message)
	{
		Yii::app()->user->setFlash(self::SUCCESS, $message);
	}
	public static function setError($message)
	{
		Yii::app()->user->setFlash(self::ERROR, $message);
	}
	public static function setWarning($message)
	{
		Yii::app()->user->setFlash(self::WARNING, $message);
	}
}