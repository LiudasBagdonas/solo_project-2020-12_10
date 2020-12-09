<?php

namespace App\Controllers\Admin;

use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\AddForm;

class AddController extends AuthController
{
    protected $form;
    protected $page;

    public function __construct()
    {
        parent:: __construct();
        $this->form = new AddForm();
        $this->page = new BasePage([
            'title' => 'Register',
        ]);
    }

    public function add()
    {

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();
            App::$db->insertRow('items', $clean_inputs + ['id' => $_SESSION['email']]);

            header('Location: /');
        }

        $this->page->setContent($this->form->render());

        return $this->page->render();
    }
}