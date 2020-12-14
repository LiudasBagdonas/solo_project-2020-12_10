<?php


namespace App\Views\Forms\Admin;

use Core\Views\Form;

class AddForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
            ],
            'fields' => [
                'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Name',
                            'class' => 'input-field',
                        ]
                    ]
                ],
                'price' => [
                    'label' => 'Price',
                    'type' => 'text',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Price',
                            'class' => 'input-field',
                        ]
                    ]
                ],
                'photo' => [
                    'label' => 'Image url',
                    'type' => 'text',
                    'value' => '',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Image url',
                            'class' => 'input-field',
                        ]
                    ]
                ]
            ],
            'buttons' => [
                'send' => [
                    'title' => 'Add',
                    'type' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn',
                        ]
                    ]
                ]
            ]]);
    }
}