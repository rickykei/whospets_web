<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return 
	array(
		//"base_url" => Yii::app()->request->baseUrl.'/hybridauth.php',
		"base_url" => Yii::app()->createAbsoluteUrl('/').'hybridauth',
		//"base_url" => Yii::app()->createAbsoluteUrl('/'),

		"providers" => array ( 
			// openid providers
			"OpenID" => array (
				"enabled" => false,
			),

			"Yahoo" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array ( 
				"enabled" => false,
			),

			"Google" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => AppProfile::model()->getLoginFacebookAppID(), "secret" => AppProfile::model()->getLoginFacebookAppSecret() ),
				  "trustForwarded" => false,
				"scope"   => "email",
				//"display" => "popup",
			),

			"Twitter" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => AppProfile::model()->getLoginTwitterConsumerKey(), "secret" => AppProfile::model()->getLoginTwitterConsumerSecret() ) 
				//"display" => "popup",
			),

			// windows live
			"Live" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),

			"MySpace" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"LinkedIn" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"Foursquare" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		//"debug_mode" => true,
		"debug_mode" => false,

		"debug_file" => "/tmp/hybridauth.log",
		//"debug_file" => "",
	);
