<?php


namespace App\Views\Forms\Admin;

use Core\Views\Form;

class UsersListForm extends Form
{

    public function __construct($user_id)
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
                'action' => '/userslist'
            ],
            'fields' => [
                'user_id' => [
                    'type' => 'hidden',
                    'value' => $user_id,
                    'extra' => [
                        'attr' => [
                            'class' => 'input-field',
                        ]
                    ]
                ],
                'role' => [
                    'type' => 'select',
                    'value' => '',
                    'options' => ['user' => 'User', 'admin' => 'Admin'],
                    'validators' => [
                        'validate_select'
                    ],
                    'extra' => [
                        'attr' => [
                            'class' => 'select_field',
                        ]
                    ]
                ]
            ],
            'buttons' => [
                'send' => [
                    'title' => 'Submit',
                    'type' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'select_btn',
                        ]
                    ]
                ]
            ]]);
    }
}