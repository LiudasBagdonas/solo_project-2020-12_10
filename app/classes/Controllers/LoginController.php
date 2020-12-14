<?php


namespace App\Controllers;

use App\App;
use App\Views\BasePage;
use App\Views\Forms\LoginForm;
use App\Views\Navigation;
use App\Controllers\Base\GuestController;

class LoginController extends GuestController
{

    protected $form;
    protected $page;

    public function __construct()
    {
        parent:: __construct();
        $this->form = new LoginForm();
        $this->page = new BasePage([
            'title' => 'Login',
        ]);
    }

    public function login()
    {

        if (!isset($_POST['redirect'])) {
            if ($this->form->validate()) {
                $clean_inputs = $this->form->values();

                App::$session->login($clean_inputs['email'], $clean_inputs['password']);

                header('Location: /');
            }
        }

        $this->page->setContent($this->form->render());

        return $this->page->render();
    }
}