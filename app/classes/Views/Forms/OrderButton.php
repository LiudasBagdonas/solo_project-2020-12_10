<?php


namespace App\Views\Forms;

use Core\Views\Form;

class OrderButton extends Form
{
    public function __construct($id = null)
    {
        parent::__construct([
            'attr' => [
                'method' => 'GET',
                'action' => '/'
            ],
            'fields' => [
                'redirect' => [
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
                    'title' => 'Add ',
                    'type' => 'post',
                    'value' => '',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn',
                        ]
                    ]
                ]
            ],
            'validators' => [
                'redirect'
            ]
        ]);
    }
}