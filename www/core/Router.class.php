<?php

class Router
{
    private $uri;
    private $listOfRoutes;

    public function __construct(string $uri, $listOfRoutes)
    {
        $this->uri = $uri;
        $this->listOfRoutes = $listOfRoutes;
    }

    public function resolveRoute()
    {
        if (!empty($this->listOfRoutes[$this->uri])) {
            $controller = $this->listOfRoutes[$this->uri]['controller'] . 'Controller';
            $action = $this->listOfRoutes[$this->uri]['action'] . 'Action';

            // Vérification s'il existe dans le dossier/controllers une class Controller
            if (file_exists("controllers/" . $controller . ".class.php")) {
                include "controllers/" . $controller . ".class.php";

                if (class_exists($controller)) {
                    $controller = new $controller();

                    if (method_exists($controller, $action)) {
                        $controller->$action();
                    } else {
                        throw new Exception('Method not found');
                    }
                } else {
                    throw new Exception('Class not found');
                }
            } else {
                throw new Exception('File not found');
            }
        } else {
            //Renvoyer une page 404 définie lorsque $listOfRoutes[$uri] est vide
            throw new Exception("URL not found : 404");
        }
    }
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