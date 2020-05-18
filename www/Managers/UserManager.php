<?php

namespace App\Managers;

use App\Core\DB;
use App\Models\User;

class UserManager extends DB {

    public function __construct()
    {
        parent::__construct(User::class, 'users');
    }

    public function getUserAdmin(){
        // Selectionner mes admin
        // Boucler sur mon résultat, créer User et mettre dans la liste à retourner
        // Retourner ma liste
    }
}