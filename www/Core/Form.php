<?php

namespace App\Core;

use App\Core\Builder\FormBuilder;

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
        foreach ($_POST as $key => $value) {
            if(false !== strpos($key, $this->name)) {
                $this->isSubmit = true;
                return true;
            }
        }

        return false;
    }

    public function isSubmitted()
    {
        return $this->isSubmit;
    }

    public function checkIsValid()
    {
        $this->isValid = true;
        foreach ($_POST as $key => $value) {
            if(false !== strpos($key, $this->name)) {
                $key = str_replace($this->name . '-', '', $key);
                $element = $this->builder->getElements($key);

                if(isset($element->getOptions()['constraints'])) {
                    foreach ($element->getOptions(['constraints']) as $constraint) {
                        $responseValidator = $this->validator->checkConstraint($constraint, $value);

                        if(null !== $responseValidator) {
                            $this->isValid = false;
                            $this->errors[$key] = $responseValidator;
                        }
                    }
                }
            }
        }
    }

    /**
     * Insère les valeurs du formualire dans $model
     */
    public function updateObject()
    {
        foreach ($_POST as $key => $value) {
            if(false !== strpos($key, $this->name)) {
                $key = str_replace($this->name . '-', '', $key);
                $method = 'set' . ucfirst($key);

                if(method_exists($this->model, $method)) {
                    $this->model->$method($value);
                }
            }
        }
    }

    /**
     *
     */
    public function associateValue()
    {

    }

    public function setModel(Model $model): self {
        $this->model = $model;
        return $this;
    }

    public function getModel(){
        return $this->model;
    }

    public function setBuilder(FormBuilder $formBuilder): self {
        $this->builder = $formBuilder;
        return $this;
    }

    public function getBuilder() {
        return $this->builder;
    }

    public function addConfig($key, $newConfig): self {
        $this->config[$key] = $newConfig;
        return $this;
    }

    public function getConfig(): array {
        return $this->config;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getErrors(): array {
        return $this->errors;
    }
}