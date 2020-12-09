<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\EditForm;

class EditController extends AuthController
{
    protected $form;
    protected $page;

    public function __construct()
    {
        parent:: __construct();
        $this->form = new EditForm();
        $this->page = new BasePage([
            'title' => 'Edit poo',
        ]);
    }

    public function edit()
    {

        $row_id = $_GET['id'] ?? null;

        if ($row_id === null) {
            header("Location: /admin/edit");
            exit();
        }

        $this->form->fill(App::$db->getRowById('items', $row_id));

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();
            App::$db->updateRow('items', $clean_inputs + ['id' => $_SESSION['email']], $_GET['id']);

            header('Location: /');
        }

        $this->page->setContent($this->form->render());
        print $this->page->render();

    }
}