<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\DeleteForm;
use Core\Views\Link;
use Core\Views\Table;

class ListController extends AuthController
{
    protected $table;
    protected $rows;
    protected $page;
    protected $form;

    public function __construct()
    {
        parent:: __construct();
        $this->page = new BasePage([
            'title' => 'List'
        ]);

        if (App::$session->getUser()) {
            $this->rows = App::$db->getRowsWhere('items', $conditions = ['id' => $_SESSION['email']]);
        } else {
            $this->rows = App::$db->getRowsWhere('items');
        }

        foreach ($this->rows as $id => $row) {
            $link = new Link([
//                'link' => "/admin/edit.php?id={$id}",
                'link' => App::$router::getUrl('edit')."?id={$id}",
                'text' => 'Edit'
            ]);
            unset($this->rows[$id]['id']);
            $this->rows[$id]['link'] = $link->render();

            $this->form = new DeleteForm($id);
            $this->rows[$id]['delete'] = $this->form->render();
        }

        $this->table = new Table([
            'headers' => [
                'X axes',
                'Y axes',
                'Color',
                'Edit',
            ],
            'rows' => $this->rows ?? []
        ]);
    }

    public function list()
    {
        if (isset($this->form)) {
            if ($this->form->validate()) {
                $clean_inputs = $this->form->values();
                App::$db->deleteRow('items', $clean_inputs['row_id']);

                header('Location: /admin/list');
            }
        }

        $this->page->setContent($this->table->render());

        return $this->page->render();
    }
}