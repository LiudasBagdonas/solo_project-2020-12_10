<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\OrderForm;
use App\Views\Forms\Admin\OrdersTable;
use App\Views\Forms\Admin\StatusForm;


class AdminOrderController extends AuthController
{
    protected $table;
    protected $page;
    protected $data;
    protected $form;

    public function __construct()
    {
        parent:: __construct();

        $this->table = new OrdersTable();
        $this->page = new BasePage([
            'title' => 'Orders',
        ]);
    }

    public function adminOrder()
    {

        $this->page->setContent($this->table->render());

        return $this->page->render();
    }
}