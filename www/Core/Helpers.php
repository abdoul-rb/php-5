<?php
namespace App\Core;

/**
 * Class contenant des fonctions utilitaires
 */

class helpers
{
    
    /**
     * getUrl renvoi l'url sous forme de chaîne à partir d'un controller et d'une action
     *
     * @param  mixed $controller
     * @param  mixed $action
     *
     * @return void
     */
    public static function getUrl($controller, $action)
    {
        $listOfRoutes = yaml_parse_file("routes.yml");
        
        foreach ($listOfRoutes as $url => $values) {
            if ($values["controller"]==$controller && $values["action"]==$action) {
                return $url;
            }
        }
        
        return "/";
    }
}
