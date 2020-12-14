<?php


namespace App\Controllers;


use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\UserOrdersTable;

class UserOrdersController extends AuthController
{
    protected $table;
    protected $page;
    protected $data;

    public function __construct()
    {
        parent:: __construct();
        $this->table = new UserOrdersTable();
        $this->page = new BasePage([
            'title' => 'My Orders',
        ]);
    }

    public function myOrders()
    {

        $this->page->setContent($this->table->render());

        return $this->page->render();
    }
}