<?php


namespace App\Views\Forms;

use App\App;
use Core\Views\Table;

class UserOrdersTable extends Table
{
    protected $data;
    protected $form;


    public function __construct()
    {
        $orders = App::$db->getRowsWhere('orders', $condition = ['email' => $_SESSION['email']]);

        foreach ($orders as $order_id => $order) {

            $this->data[$order_id] = [

                'id' => $order_id,
                'pizza' => App::$db->getRowsWhere('pizzas')[$order['pizza_id']]['name'],
                'time' => time() - $order['timestamp'],
                'status' => $order['status']
            ];


        }
        parent::__construct([
            'data' => $this->data,
            'headers' => ['ID', 'Pizza Name', 'Time Ago', 'Status']
        ]);

    }

}