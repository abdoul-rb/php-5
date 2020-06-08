<?php
namespace App\Core;
/**
* Autoloading de PHP : chargement dynamique de classe
*
* @author
*
* @since 1.0
*/
class Autoloader
{
    static function register() {
        spl_autoload_register(array(__CLASS__, function ($class) {
            $class = str_replace('App', '', $class);

            $class = str_replace('\\', '/', $class);

            if($class[0] == '/') {
                include substr($class . '.php', 1);
            } else {
                include $class . '.php';
            }
        }));
    }
}
