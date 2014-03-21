<?php

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

