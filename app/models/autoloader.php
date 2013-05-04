<?php

/**
 * autoloader to load classes in /app/models/
 */
spl_autoload_register(function ($class) {
            if (0 !== strpos($class, 'Model_')) {
                return;
            }
            
            if (is_file($file = dirname(__FILE__) . '/' . $class . '.php')) {
                require $file;
            }
        });

        
?>
