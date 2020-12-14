<?php


namespace App\Views\Forms\Admin;

use Core\Views\Form;

class StatusForm extends Form
{

    public function __construct($order_id, $status)
    {
        parent::__construct([
            'attr' => [
                'method' => 'POST',
                'action' => '/admin/order'
            ],
            'fields' => [
                'order_id' => [
                    'type' => 'hidden',
                    'value' => $order_id,
                    'extra' => [
                        'attr' => [
                            'class' => 'input-field',
                        ]
                    ]
                ],
                'status' => [
                    'type' => 'select',
                    'value' => '',
                    'options' => ['active' => 'Active', 'completed' => 'Completed', 'canceled' => 'Canceled'],
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