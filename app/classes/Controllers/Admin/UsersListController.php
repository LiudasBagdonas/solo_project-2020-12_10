<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\DeleteForm;
use Core\Views\Link;
use Core\Views\Table;
use App\Views\Forms\Admin\UsersListForm;
use App\Views\Forms\Admin\UsersListTable;


class UsersListController extends AuthController
{
    protected $table;
    protected $rows;
    protected $page;
    protected $form;

    public function __construct()
    {
        parent:: __construct();
        $this->table = new UsersListTable();
        $this->page = new BasePage([
            'title' => 'List'
        ]);

    }

    public function usersList()
    {
        $this->page->setContent($this->table->render());

        return $this->page->render();
    }
}