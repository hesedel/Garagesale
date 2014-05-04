<?php

$params=require(dirname(__FILE__).DIRECTORY_SEPARATOR.'params.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'../components/helpers.php');

$clientScript_packages=array(
	'modernizr'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('modernizr-2.6.2.min.js'),
	),
	'respond'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('respond.min.js'),
	),
	'php'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('php.min.js'),
	),

	'hes.slider'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('jquery.hes.slider.js'),
		'depends'=>array('jquery'),
	),
	'lightbox'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('jquery.lightbox-0.5.min.js'),
		'depends'=>array('jquery'),
	),
	'textarea-expander'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('jquery.textarea-expander.js'),
		'depends'=>array('jquery'),
	),
	'timeago'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('jquery.timeago.js'),
		'depends'=>array('jquery'),
	),

	'plugins'=>array(
		'baseUrl'=>'themes/responsive/js',
		'js'=>array('plugins.js'),
	),
	'bootstrap'=>array(
		'baseUrl'=>'themes/responsive/js/vendor',
		'js'=>array('bootstrap.min.js'),
		'depends'=>array('jquery'),
	),

	'form'=>array(
		'baseUrl'=>'themes/responsive/js',
		'js'=>array('form.js'),
		'depends'=>array('jquery', 'jquery.ui'),
	),
	'main'=>array(
		'baseUrl'=>'themes/responsive/js',
		'js'=>array('main.js'),
		'depends'=>array('jquery'),
	),
);

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Stycle',

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

				'items'=>'item/index',
				'post'=>'item/create',
				'item/<id:\d+>'=>'item/view',
				'item/<action:\w+>/<id:\d+>'=>'item/<action>',
				'item/<action:\w+>'=>'item/<action>',

				'user/items'=>'admin/user/items',
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
				array(
					'class'=>'CWebLogRoute',
					'categories'=>'application',
				),
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
		'clientScript'=>($params['env'] !== 'dev' && !os_is_windows()
			? array(
				'packages'=>$clientScript_packages,
				'class'=>'ext.minScript.components.ExtMinScript',
			)
			: array(
				'packages'=>$clientScript_packages,
			)
		),
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
			'noReplyEmail'=>'noreply@stycle.ph',
			'serverName'=>'http://'.$_SERVER['HTTP_HOST'].'/',
			'tagline'=>'Tagline',
			'salt'=>'pepper',
			'timeZone'=>'Australia/Sydney',
			'item_expire'=>60,
		)
	),
);
