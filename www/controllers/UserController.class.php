<?php

class UserController
{
    public function defaultAction()
    {
        echo "Action default dans le controller user";
    }
    
    public function addAction()
    {
        echo "Action add dans le controller user";
    }
    
    public function loginAction()
    {
        $myView = new View("login", "account");
    }
    
    public function registerAction()
    {

        $configForm = users::getRegisterForm();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Vérification des champs
            $errors = Validator::formValidate($configForm, $_POST);


        }

        $user = new users();

        $user->setFirstname('Abdoul');
        $user->setlastname('Rahim');
        $user->setEmail('abdoul.rahim@bah.fr');
        $user->setPassword(" Secret_");
        $user->setStatus(0);

        $user->save();

        $myView = new View("register", "account");
        $myView->assign('configForm', $configForm);
    }
    
    public function forgotPwdAction()
    {
        $myView = new View("forgotPwd", "account");
    }
}
