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
            'title' => 'Edit poo',
        ]);
    }

    public function add()
    {

        if ($_POST['redirect_add'] !== 'redirect_add') {
            if ($this->form->validate()) {
                $clean_inputs = $this->form->values();
                App::$db->insertRow('pizzas', [
                    'photo' => $clean_inputs['photo'],
                    'name' => $clean_inputs['name'],
                    'price' => $clean_inputs['price']
                ]);

                header('Location: /');
            }
        }
        $this->page->setContent($this->form->render());
        print $this->page->render();

    }
}