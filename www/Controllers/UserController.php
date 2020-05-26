<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Managers\UserManager;
use App\Core\Exceptions\NotFoundException;

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
        $user = new User();

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

    public function getAction($params)
    {
        $userManager = new UserManager();
        $user = $userManager->find($params['id']);

        if(!$user) {
            throw new NotFoundException("User not found");
        }
        $users = $userManager->findAll();
        $partialUsers = $userManager->findBy(['firstname' => "Fadyl%"], ['id' => 'desc']);
        $userManager->delete(5);

        echo "get user";
    }

}
