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
                'xaxes' => [
                    'label' => 'X coordinates',
                    'type' => 'number',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_number'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'X coordinates...',
                            'class' => 'input-field',
                        ]
                    ]
                ],
                'yaxes' => [
                    'label' => 'Y coordinates',
                    'type' => 'number',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_number'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Y coordinates...',
                            'class' => 'input-field',
                        ]
                    ]
                ],
                'color' => [
                    'label' => 'Select color',
                    'type' => 'select',
                    'value' => 'option',
                    'options' => ['black' => 'Black', 'red' => 'Red', 'blue' => 'Blue', 'green' => 'Green'],
                    'validators' => [
                        'validate_select'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'colors',
                            'class' => 'input-field',
                        ]
                    ]
                ],
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
            ],
            'validators' => [
                'validate_coordinates_overlap'
            ]]);
    }
}