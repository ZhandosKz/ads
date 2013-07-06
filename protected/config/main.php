<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(require('../settings/main.php'),array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.behaviors.*',
		'application.helpers.*',
		'application.widgets.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
				'yii_booster.gii'
			),
		),
		'ads' => array(
		),
		'admin' => array(
		)
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl' => array('login')
		),

		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
		),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<action:(login|logout|register)>' => 'auth/<action>',
				array(
					'class' => 'application.components.CategoryUrlRule',
					'connectionID' => 'db',
				),
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
					'css' => array('css/custom.css'),

					'depends' => array('jquery')
				),
			)
		),
		'bootstrap' => array(
			'class' => 'ext.bootstrap.components.Bootstrap'
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