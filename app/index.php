<?php

require ROOT . '/app/config/registry.php';
require ROOT . '/app/config/appconfig.php';

// Instantiate application
$app = new \Slim\Slim(array(
	'templates.path' => ROOT.'/app/views/',
	'debug' => true,
	'view' => new \Slim\Extras\Views\Twig(),
 	'cookies.secret_key' => md5('appsecretkey'),

	'log.enabled'    => true,
	'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
				'path' => './app/logs',
				'name_format' => 'Y-m-d',
				'message_format' => '%label% - %date% - %message%'
		))
));
$app->setName('appname');

// For native PHP session
session_cache_limiter(false);
session_start();
// For encrypted cookie session 
/*
$app->add(new \Slim\Middleware\SessionCookie(array(
            'expires' => '20 minutes',
            'path' => '/',
            'domain' => null,
            'secure' => false,
            'httponly' => false,
            'name' => 'app_session_name',
            'secret' => md5('appsecretkey'),
            'cipher' => MCRYPT_RIJNDAEL_256,
            'cipher_mode' => MCRYPT_MODE_CBC
        )));
*/

/*
 * SET some globally available view data
 */
$resourceUri = $_SERVER['REQUEST_URI'];
$rootUri = $app->request()->getRootUri();
$assetUri = $rootUri;
$app->view()->appendData(
		array('currentUser' => $currentUser,
				'app' => $app,
				'rootUri' => $rootUri,
				'assetUri' => $assetUri,
				'resourceUri' => $resourceUri
));

foreach(glob(ROOT.'/app/controllers/*.php') as $router) {
	include $router;
}

$app->run();
