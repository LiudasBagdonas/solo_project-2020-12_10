<?php


namespace App\Views\Forms;

use Core\Views\Form;

class LoginButton extends Form
{
    public function __construct()
    {
        parent::__construct([
            'attr' => [
                'method' => 'GET',
                'action' => '/login'
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
                    'title' => 'Login ',
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