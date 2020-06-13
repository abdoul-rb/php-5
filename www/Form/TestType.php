<?php

namespace App\Form;

use App\Core\Builder\FormBuilder\FormBuilder;
use App\Core\Constraints\Length;
use App\Core\Form;
use App\Models\User;

class TestType extends Form
{
    public function buildForm(FormBuilder $builder)
    {
        $this->setBuilder($builder->add('firstname', 'text', [
            'label' => 'Votre prénom',
            'required' => true,
            'attr' => [
                'placeholder' => 'Votre prénom',
                'class' => 'form-control form-control-user'
            ],
            'constraints' => [
                new Length(2, 50, 'Votre prénom doit conténir au moins 2 caractères', 'Votre prénom doit conténir au plus 50 caractères')
            ]])->add('submit', 'submit', [
                'label' => 'Soumettre',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
        ]));
    }

    public function configureOptions(): void {
        $this->addConfig('class', User::class)
             ->setName('testype')
             ->addConfig('attr', [
                 'id' => 'formRegisteruser',
                 'class' => 'user'
             ]);
    }
}