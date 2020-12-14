<?php


namespace App\Views\Forms;

use Core\Views\Form;

class EditButton extends Form
{
    public function __construct($id)
    {
        parent::__construct([
            'attr' => [
                'method' => 'GET',
                'action' => '/edit'
            ],
            'fields' => [
                'redirect_edit' => [
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
                'redir_button' => [
                    'title' => 'Edit',
                    'type' => 'post',
                    'value' => '',
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