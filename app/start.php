<?php

/*
|--------------------------------------------------------------------------
| Create Slim Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Slim application instance
| which serves as the "glue" for all the components of RedSlim.
|
*/

// Instantiate application
$app = new \Slim\Slim(require_once ROOT . '/app/config/app.php');
$app->setName('RedSlim');


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
		array(		'app' => $app,
				'rootUri' => $rootUri,
				'assetUri' => $assetUri,
				'resourceUri' => $resourceUri
));

foreach(glob(ROOT . '/app/controllers/*.php') as $router) {
	include $router;
}

/*
|--------------------------------------------------------------------------
| Configure Twig
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

\Slim\Extras\Views\Twig::$twigDirectory = ROOT . '/vendor/twig/twig/lib/Twig';
\Slim\Extras\Views\Twig::$twigOptions = array(
    'auto_reload' => true,
    'debug' => true,
    //'strict_variables' => true
);

if (is_writable(ROOT . '/app/storage/cache/twig')) {
    \Slim\Extras\Views\Twig::$twigOptions['cache'] = ROOT . '/app/storage/cache/twig';
}

\Slim\Extras\Views\Twig::$twigExtensions = array(
    'Twig_Extensions_Slim',
    'Twig_Extension_Debug',
    'Twig_Extensions_Extension_Text',    
    //'Twig_Extensions_Markdown',
);

//\Slim\Extras\Views\Twig::$twigFunctions = array(
//);

/*
|--------------------------------------------------------------------------
| Create Redbean DAO
|--------------------------------------------------------------------------
|
| Create the loader class R to read the connection parameters and setup
| the connection.
|
*/
class R extends RedBean_Facade {
    
    static function loadConfig($config) {
        
        $conn = $config['connections'][$config['default']];       
        
        switch($conn['driver']) {
            case 'mysql':
                self::setup ($conn['driver'] . ':host=' . $conn['host'] . '; dbname=' . $conn['database'], $conn['username'], $conn['password']);
                break;
            case 'sqlite':
                self::setup ($conn['driver'] . ':' . $conn['database']);
                break;
        }
    }
    
}

R::loadConfig(require_once ROOT . '/app/config/database.php');

// Disable fluid mode in production environment
$app->configureMode(SLIM_MODE_PRO, function () use ($app) {
    // note, transactions will be auto-committed in fluid mode
    R::freeze(true);  
});
      

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
