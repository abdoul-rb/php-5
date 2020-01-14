<?php

class users extends DB
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

    public function setID($id)
    {
        // Faire du populate lorsque je fais un setID - appeler une methode qui va aller chercher tout les info
        // sur les user contiendra toute la data methode populate créer dans DB
        $this->id = $id;
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

    /**
     * @return array un formulaire à partir des données du tableau qui lui sera passé.
     */
    public static function getRegisterForm(){
        return [
            'config' => [
                'method' => 'POST',
                'action' => helpers::getUrl('User', 'register'),
                'class' => '',
                'id' => '',
                'submit' => "S'inscrire"
            ],
            'fields' => [
                'firstname' => [
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'Votre prénom',
                    'class' => '',
                    'id' => '',
                    'value' => ''
                ],
                'lastname' => [
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'Votre nom',
                    'class' => '',
                    'id' => '',
                    'value' => ''
                ],
                'email' => [
                    'type' => 'email',
                    'required' => true,
                    'placeholder' => 'Votre email',
                    'class' => '',
                    'id' => '',
                    'value' => ''
                ],
                'password' => [
                    'type' => 'password',
                    'required' => true,
                    'placeholder' => 'Votre mot de passe',
                    'class' => '',
                    'id' => '',
                    'value' => ''
                ],
                'passwordConfirm' => [
                    'type' => 'password',
                    'required' => true,
                    'placeholder' => 'Confirmer votre mot de passe',
                    'class' => '',
                    'id' => '',
                    'value' => '',
                    'confirmWith' => ''
                ],
                'captcha' => [
                    'type' => 'captcha',
                    'required' => true,
                    'placeholder' => 'Saisir le texte',
                    'class' => '',
                    'id' => '',
                    'value' => '',
                ]
            ]
        ];
    }
}
