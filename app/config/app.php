<?php
/*
 * (Slim) Application Config
 */

define('SLIM_MODE_DEV', 'development');
define('SLIM_MODE_PRO', 'production');
define('SLIM_MODE', SLIM_MODE_DEV);

return array(
    'mode' => SLIM_MODE,
    'cookies.secret_key' => md5('appsecretkey'),
    'view' => new \Slim\Views\Twig(),
    'templates.path' => ROOT . '/app/views/',
    
    'debug' => SLIM_MODE === SLIM_MODE_DEV,
    'log.enabled' => SLIM_MODE === SLIM_MODE_PRO,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => ROOT . '/app/storage/logs',
        'name_format' => 'Y-m-d',
        'message_format' => '%label% - %date% - %message%'
            ))
);



