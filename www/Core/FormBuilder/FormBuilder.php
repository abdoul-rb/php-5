<?php

namespace App\Core\FormBuilder;

class FormBuilder implements FormBuilderInterface
{
    private $elements = [];

    public function remove(string $name): FormBuilderInterface {
        unset($this->elements[$name]);

        return $this;
    }

    public function getElements(): ?array {
        return $this->elements;
    }

    public function getElement(string $value): ?ElementFormBuilderInterface {
        return $this->elements[$value];
    }

    public function setValue(string $key, string $value): ?ElementFormBuilderInterface {
        $this->elements[$key] = $this->setValue($key, $value);

        return $this;
    }
}