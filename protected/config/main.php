<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(require('../settings/main.php'),array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'ads' => array(
			'import' => array(
				'application.modules.ads.components.*'
			),
		)
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName' => FALSE
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'clientScript'=>array(
			'packages' => array(
				// Уникальное имя пакета
				'bootstrap_theme' => array(
					// Где искать подключаемые файлы JS и CSS
					'baseUrl' => '/themes/twitter_bootstrap/public',
					'css' => array('css/bootstrap.min.css', 'css/bootstrap-responsive.min.css', 'css/custom.css'),
					'js' => array('js/bootstrap.min.js'),
					'depends' => array('jquery')
				),
			)
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
	'language' => 'ru',
	'theme' => 'twitter_bootstrap'
));