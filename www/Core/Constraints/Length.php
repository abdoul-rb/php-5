<?php

namespace App\Core\Constraints;

use App\Core\Builder\FormBuilder\FormBuilderInterface;

class Length implements FormBuilderInterface
{
    protected $min;
    protected $max;
    protected $minMessage;
    protected $maxMessage;
    protected $errors = [];

    public function __construct(string $min, string $max, string $minMessage = null, string $maxMessage = null)
    {
        $this->min = $min;
        $this->max = $max;
        $this->minMessage = $minMessage;
        $this->maxMessage = $maxMessage;

        if(null == $this->minMessage) {
            $this->minMessage = 'Le champ doit conténir au moins ' . $min . 'caractères.';
        }

        if(null == $this->maxMessage) {
            $this->maxMessage = 'Le champ doit conténir au moins ' . $max . 'caractères.';
        }
    }

    /**
     * Vérifie que la valeur est bien engtre 'min' et 'max', sinon on ajoute dans errors
     * @param string $value
     * @return bool
     */
    public function isValid(string $value): bool {
        $this->errors = [];

        if(strlen($value) < $this->min) {
            $this->errors = $this->minMessage;
        }

        if(strlen($value) > $this->max) {
            $this->errors = $this->maxMessage;
        }

        return (0 == count($this->errors));
    }

    /**
     * Retourne le tableau d'erreurs.
     * @return array
     */
    public function getErrors(): array {
        return $this->errors;
    }
}