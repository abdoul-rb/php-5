<?php

namespace App\Core;

class Form
{
    private $builder;
    private $config = [];
    private $model;
    private $name;
    private $isSubmit = false;
    private $isValid = false;
    private $validator;
    private $errors = [];

    public function __construct()
    {
        $this->validator = new Validator();

        $this->config = [
          'method' => 'POST',
          'action' => '',
          'attr' => [],
        ];
    }
}