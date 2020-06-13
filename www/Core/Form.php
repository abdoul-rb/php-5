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

    /**
     *
     */
    public function associateValue()
    {

    }

    /**
     * Récupère les elements du builder
     * @return array|null
     */
    public function getElements(): ?array {
        return $this->builder->getElements();
    }

    public function handle(): void {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isSubmit = $this->checkIsSubmitted();

            if($isSubmit) {
                $this->checkIsValid();
            }
            
            $this->updateObject();
        }
    }

    private function checkIsSubmitted()
    {
    }

    public function isSubmitted()
    {
        return $this->isSubmit;
    }

    public function checkIsValid()
    {
    }

    public function updateObject()
    {
    }
}