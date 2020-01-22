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
                    'class' => 'form-control',
                    'id' => '',
                    'value' => '',
                    'minlength' => 2,
                    'maxlength' => 50,
                    'errMsg' => '2 et 100 caractères',
                ],
                'lastname' => [
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'Votre nom',
                    'class' => 'form-control',
                    'id' => '',
                    'value' => '',
                    'minlength' => 2,
                    'maxlength' => 100,
                    'errMsg' => '2 et 100 caractères',
                ],
                'email' => [
                    'type' => 'email',
                    'required' => true,
                    'placeholder' => 'Votre email',
                    'class' => 'form-control',
                    'id' => '',
                    'value' => '',
                    'errMsg' => 'Email incorrect',
                ],
                'password' => [
                    'type' => 'password',
                    'required' => true,
                    'placeholder' => 'Votre mot de passe',
                    'class' => 'form-control',
                    'id' => '',
                    'value' => '',
                    'errMsg' => 'Mot de passe doit conténir une majuscule et une miniscule avec au moins 8 caractères',
                ],
                'passwordConfirm' => [
                    'type' => 'password',
                    'required' => true,
                    'placeholder' => 'Confirmer votre mot de passe',
                    'class' => 'form-control',
                    'id' => '',
                    'value' => '',
                    'confirmWith' => 'password',
                    'errMsg' => 'Confirmation de mot de passe incorrect',
                ],
                'captcha' => [
                    'type' => 'captcha',
                    'required' => true,
                    'placeholder' => 'Saisir le texte',
                    'class' => 'form-control',
                    'id' => '',
                    'value' => '',
                    'errMsg' => 'Captcha incorrect',
                ]
            ]
        ];
    }
}
