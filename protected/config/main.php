<?php

$params=require(dirname(__FILE__).DIRECTORY_SEPARATOR.'params.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'../components/helpers.php');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Garagesale.ph',

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
			'password'=>$params['gii.password'],
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
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
				'/'=>'site/index',
				'login'=>'site/login',
				'logout'=>'site/logout',
				'register'=>'site/register',
				'maintenance'=>'site/maintenance',

				'ad'=>'item/index',
				'post'=>'item/create',
				'ad/<id:\d+>'=>'item/view',
				'ad/<action:\w+>/<id:\d+>'=>'item/<action>',
				'ad/<action:\w+>'=>'item/<action>',

				'user/ads'=>'admin/user/items',
				'user/<action:\w+>/<id:\w+>'=>'admin/user/<action>',
				'user/<action:\w+>'=>'admin/user/<action>',

				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
			'urlSuffix'=>'/',
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString'=>'mysql:host='.$params['db.host'].';dbname='.$params['db.name'],
			'emulatePrepare'=>true,
			'username'=>$params['db.username'],
			'password'=>$params['db.password'],
			'charset'=>'utf8',
		),
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
			'defaultRoles'=>array('?','@'),
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'viewRenderer'=>array(
			'class'=>'ext.phamlp.Haml',
			'filterPathAlias'=>'ext.phamlp.filters',
			// delete options below in production
			/*
			'ugly'=>false,
			'style'=>'nested',
			'debug'=>0,
			'cache'=>false,
			*/
		),
		'clientScript'=>(!os_is_windows() ? array(
			'class'=>'ext.minScript.components.ExtMinScript'
		) : array()),
	),

	'controllerMap'=>array(
		'min'=>array(
			'class'=>'ext.minScript.controllers.ExtMinScriptController'
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array_merge(
		$params,
		array(
			// this is used in contact page
			'adminEmail'=>'hes@pajaroncreative.com',
			'noReplyEmail'=>'noreply@garagesale.ph',
			'serverName'=>'http://'.$_SERVER['HTTP_HOST'].'/',
			'tagline'=>'Tagline',
			'salt'=>'pepper',
			'timeZone'=>'Asia/Manila',
			'item_expire'=>60,
		)
	),
);
