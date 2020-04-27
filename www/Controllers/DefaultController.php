<?php
namespace App\Controllers;

use App\Core\View;

class DefaultController
{
    /**
     * Action exécuter lorsqu'aucune autre action n'est spécifié
     *
     * @return void
     */
    public function defaultAction()
    {
        //Depuis la base de données récupéré le prénom
        $name = 'Abdoul Rahim';
    
        $myView = new View("dashboard");
        $myView->assign("name", $name);
    }
}
