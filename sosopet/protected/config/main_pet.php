<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Kickzmall',
	'sourceLanguage'=>'en',
	'language'=>'en',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.shop.models.*',
		'application.modules.shop.components.*',
		'application.modules.user.models.*',
	),
	
	'aliases' => array(
		//If you manually installed it
		'xupload' => 'ext.xupload'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'kixify2014',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'shop'=>array(
			'debug'=>false,
		),
		'user' => array(
			//'debug' => true,
			'userTable' => 'user',
			'translationTable' => 'translation',
			'mailer' => 'PHPMailer',
			//'enableBootstrap' => true,
			'enableBootstrap' => false,
			'loginType' => 7,
			'hybridAuthProviders' => array('facebook', 'twitter'),
			'enableLogging' => true,
		),
		'registration' => array(
		),
		'profile' => array(
			'privacySettingTable' => 'privacysetting',
			'profileTable' => 'profile',
			//'profileCommentTable' => 'profile_comment',
			'profileVisitTable' => 'profile_visit',
		),
		'avatar' => array(
			'enableGravatar' => false,
			'avatarPath' => 'images/user',
		),
	),

	// application components
	'components'=>array(
		/*
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		*/
		'user'=>array(
			'class' => 'application.modules.user.components.YumWebUser',
			'allowAutoLogin'=>true,
			'loginUrl' => array('//user/user/login'),
		),
		'cache'=>array( 'class'=>'system.caching.CDummyCache',	),
		'request'=>array(
			'enableCookieValidation'=>true,
			//'enableCsrfValidation'=>true,
		),		
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'urlManager'=>array(
			'class'=>'application.components.UrlManager',
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				// '<language:(de|tr|en|ja)>/' => 'site/index',
				// '<language:(de|tr|en|ja)>/<action:(contact|login|logout)>/*' => 'site/<action>',
				// '<language:(de|tr|en|ja)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// '<language:(de|tr|en|ja)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<language:(de|tr|en|ja)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
				'hybridauth'=>array('', 'verb'=>'GET', 'urlSuffix'=>'.php'),
				'<language:(zh|en|ja)>/' => 'site/index',
				'<id:[\w ]+>' => '/shop/store/search',
                '<language:(zh|en|ja)>/<action:(contact|captcha)>/*' => 'site/<action>',
                '<language:(zh|en|ja)>/<controller:(user)>' => '<controller>',
				'<language:(zh|en|ja)>/<id:[\w ]+>' => '/shop/store/search',
                '<language:(zh|en|ja)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<language:(zh|en|ja)>/<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<language:(zh|en|ja)>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
				'<language:(zh|en|ja)>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\w+>' => '<module>/<controller>/<action>',
                '<language:(zh|en|ja)>/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<language:(zh|en|ja)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(zh|en|ja)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sosopet',
			'emulatePrepare' => true,
			'username' => 'sosopet',
			'password' => '98014380',
			'charset' => 'utf8',
			'tablePrefix' => '',
			'initSQLs'=>array("SET time_zone = '+8:00'"),
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		/*
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
				),
				
			),
		),
		*/
		'phpThumb'=>array(
			'class'=>'ext.EPhpThumb.EPhpThumb',
			//'options'=>array(optional phpThumb specific options are added here)
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'pointEnable'=>true,
		//'languages'=>array('tr'=>'Turkce', 'en'=>'English', 'de'=>'Deutsch', 'ja'=>'Japanese',),
		'languages'=>array('en'=>'English', 'zh'=>'中',),
	),
	'language'=>'en',
	'timeZone' => 'Asia/Hong_Kong',
);