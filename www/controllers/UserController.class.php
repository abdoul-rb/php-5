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
        $user = new users();
        $user->hydrate( [
            'id' => 1,
            'firstname' => 'Yves',
        ]);
        #$user->setId(1);
        #$user->setFirstname("Yves");
        $user->save();
        $user = new users();

        /* $user->setFirstname('Abdoul');
        $user->setlastname('Rahim');
        $user->setEmail('abdoul.rahim@bah.fr');
        $user->setPassword(" Secret_");
        $user->setStatus(0);

        $user->save();*/

        $myView = new View("register", "account");
    }
    
    public function forgotPwdAction()
    {
        $myView = new View("forgotPwd", "account");
    }
}
