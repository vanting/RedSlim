<?php
/**
 * RedSlim (Slim + Twig + Redbean), a PHP micro framework
 *
 * @package  redslim
 * @author   Van Ting <vanting@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| System Settings
|--------------------------------------------------------------------------
|
| Set the error reporting mode and time zone.
|
 */
error_reporting(E_ALL | E_STRICT);
error_reporting(error_reporting() & ~E_NOTICE);       // ignore error notice of undefined variables
date_default_timezone_set('Asia/Hong_Kong');

define('ROOT', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require ROOT . '/app/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let's turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight these users.
|
*/

$app = require_once ROOT . '/app/start.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can simply call the run method,
| which will execute the request and send the response back to
| the client's browser allowing them to enjoy the creative
| and wonderful applications we have created for them.
|
*/

$app->run();
