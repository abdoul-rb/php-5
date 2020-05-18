<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\Users;

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
        $user = new Users();

        $user->setFirstname('Abdoul');
        $user->setlastname('Rahim');
        $user->setEmail('abdoul.rahim@bah.fr');
        $user->setPassword(" Secret_");
        $user->setStatus(0);
        $user->save();

        /*$user->hydrate([
            'id' => 1,
            'firstname' => 'Bah',
            'lastname' => 'Abdoul Rahim',
            'email' => 'abdoul_rahim.bah@gmail.com',
            'password' => 'password',
            'status' => 1
        ]);*/

        $user->save();

        $myView = new View("register", "account");
    }
    
    public function forgotPwdAction()
    {
        $myView = new View("forgotPwd", "account");
    }
}
