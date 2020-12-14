<?php


namespace App\Views\Forms;

use Core\Views\Form;

class AddButton extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
                'action' => '/add'
            ],
            'fields' => [
                'redirect_add' => [
                    'type' => 'hidden',
                    'value' => 'redirect_add',
                    'extra' => [
                        'attr' => [
                            'class' => 'input-field',
                        ]
                    ]
                ],
            ],
            'buttons' => [
                'redir_button' => [
                    'title' => 'Add ',
                    'type' => 'post',
                    'value' => '',
                    'extra' => [
                        'attr' => [
                            'class' => 'add_button',
                        ]
                    ]
                ]
            ]
        ]);
    }
}