<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $status;

    public function __construct()
    {
        parent::__construct();
    }

    public function setID($id): self
    {
        // Faire du populate lorsque je fais un setID - appeler une methode qui va aller chercher tout les info
        // sur les user contiendra toute la data methode populate créer dans DB
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    public function setLastname($lastname)
    {
        $this->lastname = strtolower(trim($lastname));
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
