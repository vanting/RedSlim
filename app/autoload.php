<?php

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/


// Twig extension auto loading
require ROOT . '/vendor/slim/extras/Views/Extension/TwigAutoloader.php';
// Slim class name not Slim_Slim
require ROOT . '/vendor/slim/slim/Slim/Slim.php';
// slim extra has no PSR-0 autoloader support in this version
require ROOT . '/vendor/slim/extras/Views/TwigView.php';
// Twig extension manually loading
require ROOT . '/vendor/twig/twig/lib/Twig/ExtensionInterface.php';
require ROOT . '/vendor/twig/twig/lib/Twig/Extension.php';
require ROOT . '/vendor/twig/extensions/lib/Twig/Extensions/Extension/Text.php';

require ROOT . '/vendor/gabordemooij/redbean/RedBean/redbean.inc.php';


/*
|--------------------------------------------------------------------------
| Register The RedSlim Auto Loader
|--------------------------------------------------------------------------
|
| We register an auto-loader "behind" the Composer loader that can load
| model classes on the fly.
|
*/

// Autoloader to load classes in /app/models/
spl_autoload_register('autoloader_model');

function autoloader_model($class) {
            if (0 !== strpos($class, 'Model_')) {
                return;
            }

            if (is_file($file = ROOT . '/app/models/' . $class . '.php')) {
                require $file;
            }
        }

        
?>
