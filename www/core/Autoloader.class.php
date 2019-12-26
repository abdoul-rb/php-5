<?php

/**
* Autoloading de PHP : chargement dynamique de classe
*
* @author
*
* @since 1.0
*/
class Autoloader
{
    public static function autoload($className)
    {
        if (file_exists( 'core/' . $className . '.class.php')) {
            include $className . '.class.php';
        } elseif (file_exists('../models/' . $className . '.model.php')) {
            include '../models/' . $className . '.model.php';
        }
    }
}

spl_autoload_register(['Autoloader', 'autoload']);