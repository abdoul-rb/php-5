<?php
namespace App\Controllers;

use App\Core\View;
use App\Form\TestType;
use App\Models\User;

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

    public function testFormAction() {
        $user = (new User())->setFirstname('Abdoul Rahim');
        $form = $this->createForm(TestType::class, $user);
        $form->handle();

        if($form->isSubmit() && $form->isValid()) {
            // Save le nouveau modèle valide du user
        }

        $this->render('editProfile', 'account', [
            'formProfile' => $form
        ]);
    }
}
