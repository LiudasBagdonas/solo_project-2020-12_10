<?php


namespace App\Views\Forms\Admin;

use App\App;
use Core\Views\Table;

class OrdersTable extends Table
{
    protected $data;
    protected $statusTable;
    protected $form;


    public function __construct()
    {
        $orders = App::$db->getRowsWhere('orders');


        foreach ($orders as $order_id => $order) {

            $this->form = new StatusForm($order_id, $order['status']);
            $this->form->fill(App::$db->getRowById('orders', $order_id));
            $user = App::$db->getRowWhere('users', $conditions = ['email' => $order['email']]);

            $this->data[$order_id] = [
                'id' => $order_id,
                'username' => $user['username'],
                'pizza' => App::$db->getRowsWhere('pizzas')[$order['pizza_id']]['name'],
                'time' => date('H:i', time() - $order['timestamp']) . ' h',
                'status' => $this->form->render()
            ];

//            var_dump(App::$db->getRowById('orders', $order_id)['status']);
//            $this->form->fill(App::$db->getRowById('orders', $order_id));

        }

        parent::__construct([
            'data' => $this->data,
            'headers' => ['ID', 'User Name', 'Pizza Name', 'Time Ago', 'Status']
        ]);


            if ($this->form->validate()) {
                $row = App::$db->getRowById('orders', $_POST['order_id']);
                $row['status'] = $_POST['status'];

                App::$db->updateRow('orders',$row ,$_POST['order_id']);
            }
    }

}