<?php

/**
 * Autoloading de PHP
 */

/**
 * Systeme de routing natif
 */

// require 'core/Autoloader.class.php';
// Autoloader::register();


function myAutoload($className)
{
    if (file_exists("core/" . $className . ".class.php")) {
        include "core/" . $className . ".class.php";
    } elseif (file_exists("models/" . $className . ".model.php")) {
        include "models/" . $className . ".model.php";
    }
}

spl_autoload_register("myAutoload");

new ConstLoader();

$uri = $_SERVER['REQUEST_URI'];

$listOfRoutes = yaml_parse_file("routes.yml");

if (!empty($listOfRoutes[$uri])) {
    $controller = $listOfRoutes[$uri]['controller'] . 'Controller';
    $action = $listOfRoutes[$uri]['action'] . 'Action';

    // Vérification s'il existe dans le dossier /controllers une class Controller
    if (file_exists("controllers/" . $controller . ".class.php")) {
        include "controllers/" . $controller . ".class.php";

        if (class_exists($controller)) {
            $controller = new $controller();

            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                die("L'action demandée n'existe pas !");
            }
        } else {
            die("La class demandée n'existe pas !");
        }
    } else {
        die("Le fichier du controller n'existe pas: controllers/" . $controller . ".class.php");
    }
} else {
    //Renvoyer une page 404 définie
    die("L'URL n'existe pas : ERROR 404 ");
}

/**
* $uri = trim($uri, '/');

* $args = explode('/', $uri);

* $controller = ucfirst((empty($args[0])) ? 'default' : $args[0]) . 'Controller';
* $action = ((empty($args[1])) ? 'default' : $args[1]) . 'Action';

* if(file_exists('controllers/' . $controller . '.class.php'))
* {
*    include 'controllers/' . $controller . '.class.php';

*    if(class_exists($controller))
*    {
*        $controller = new $controller();

*        if(method_exists($controller, $action))
*        {
*            $controller->$action();
*        }
*        else
*        {
*            die("L'action n'existe pas");
*        }
*    }
*    else
*    {
*        die("La classe controller n'existe pas");
*    }
*}
*else
*{
*    die("Le fichier du controller n'existe pas");
*}
 */
