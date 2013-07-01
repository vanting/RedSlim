<?php

/**
 * GENERAL SETTINGS
 * 
 * This determines which errors are reported by PHP (default all)
 */
error_reporting(E_ALL | E_STRICT);
error_reporting(error_reporting() & ~E_NOTICE);       // ignore error notice of undefined variables
date_default_timezone_set('Asia/Hong_Kong');

/**
 * REDBEAN SETTINGS
 */

// MySQL
$dbName = $_SERVER["DB1_NAME"];
$dbHost = $_SERVER["DB1_HOST"];
$dbPort = '3306';
$dbUser = $_SERVER["DB1_USER"];
$dbPassword = $_SERVER["DB1_PASS"];
R::setup('mysql:host=' . $dbHost . '; dbname=' . $dbName, $dbUser, $dbPassword);

// Disable fluid mode so as to prevent from auto-commit in a transaction
//R::freeze(true);        

/**
 * TWIG SETTINGS
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



