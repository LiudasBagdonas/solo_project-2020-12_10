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
var_dump($_GET);

        $this->form->fill(App::$db->getRowById('pizzas', $_GET['redirect_edit']));

        if (isset($_GET['redirect_edit'])) {
            if ($this->form->validate()) {

                $clean_inputs = $this->form->values();

                App::$db->updateRow('pizzas', $clean_inputs, $_GET['redirect_edit']);

                header('Location: /');
            }
        }

        $this->page->setContent($this->form->render());
        print $this->page->render();

    }
}