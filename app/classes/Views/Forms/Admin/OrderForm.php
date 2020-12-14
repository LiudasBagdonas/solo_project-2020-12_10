<?php

namespace App\Views\Forms\Admin;

use Core\Views\Form;

class OrderForm extends Form
{
    public function __construct($pizza_index = null)
    {
        parent::__construct([
            'attr' => [
                'method' => 'GET',
                'action' => '/'
            ],
            'fields' => [
                'order_id' => [
                    'type' => 'hidden',
                    'value' => $pizza_index,
                    'extra' => [
                        'attr' => [
                            'class' => 'input-field',
                        ]
                    ]
                ]
            ],
            'buttons' => [
                'order' => [
                    'title' => 'Order',
                    'type' => 'submit',
                    'value' => '',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn',
                        ]
                    ]
                ]
            ]]);
    }
}