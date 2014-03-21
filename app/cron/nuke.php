<?php

/*
 * Cron job:
 * - nukes the entire database
 */
define('ROOT', dirname(dirname(__DIR__)));

require ROOT . '/app/autoload.php';
require ROOT . '/app/dbloader.php';

R::nuke();

?>
