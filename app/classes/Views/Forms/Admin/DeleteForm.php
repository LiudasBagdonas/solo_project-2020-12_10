<?php


namespace App\Views\Forms\Admin;


use Core\Views\Form;

class DeleteForm extends Form
{
    public function __construct($id)
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
            ],
            'fields' => [
                'row_id' => [
                    'type' => 'hidden',
                    'value' => $id,
                    'extra' => [
                        'attr' => [
                            'class' => 'input-field',
                        ]
                    ]
                ],
            ],
            'buttons' => [
                'delete' => [
                    'title' => 'Delete',
                    'type' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn',
                        ]
                    ]
                ]
            ]
        ]);
    }
}