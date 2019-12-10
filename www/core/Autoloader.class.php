<?php

/**
* Autoloading de PHP : chargement dynamique de classe
*
* @author  Mike van Riel <me@mikevanriel.com>
*
* @since 1.0
*/
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($className)
    {
        if ($className . ".class.php") {
            include $className . ".class.php";
        } elseif (file_exists("models/" . $class . ".class.php")) {
            include "models/" . $class . ".class.php";
        }
    }
}
