<?php

namespace App\Controllers;

use App\app;
use App\Views\BasePage;
use App\Views\Forms\OrderButton;
use App\Views\Forms\AddButton;
use App\Views\Forms\EditButton;
use App\Views\Forms\LoginButton;

use App\Views\Forms\Admin\OrderForm;
use App\Views\Forms\Admin\DeleteForm;
use App\Views\Forms\Admin\Editform;

use Core\View;

class HomeController extends \App\Abstracts\Controller
{
    protected $form;
    protected $page;
    protected $data;
    protected $orderForm;
    protected $addForm;
    protected $editForm;

    /**
     * Controller constructor.
     *
     * We can write logic common for all
     * other methods
     *
     * For example, create $page object,
     * set it's header/navigation
     * or check if user has a proper role
     *
     * Goal is to prepare $page
     */
    public function __construct()
    {
        if (!App::$session->getUser()) {
            $this->form = new LoginButton();


            $this->data = App::$db->getRowsWhere('pizzas');

            // TODO: Implement index() method.

            $content = new View([
                'pizzas' => $this->data,
                'login' => $this->form->render()
            ]);

            $this->page = new BasePage([
                'title' => 'Pizzas list',
                'content' => $content->render(ROOT . '/app/templates/content/index.tpl.php')
            ]);
        }

        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                {
                    $this->data = App::$db->getRowsWhere('pizzas');
                    foreach ($this->data as $pizza_index => $pizza) {

                        $this->editForm = new EditButton($pizza_index);
                        $this->data[$pizza_index]['edit_button'] = $this->editForm->render();

                        $this->form = new DeleteForm($pizza_index);
                        $this->data[$pizza_index]['delete'] = $this->form->render();
                    }

                    $this->addForm = new AddButton();

//                    $this->data['redirect'] = $this->form->render();

                    // TODO: Implement index() method.
                    $content = new View([
                        'pizzas' => $this->data,
                        'redirect' => $this->addForm->render(),
                    ]);


                    $this->page = new BasePage([
                        'title' => 'Pizzas list',
                        'content' => $content->render(ROOT . '/app/templates/content/index.tpl.php')
                    ]);
                }
            }


            if ($_SESSION['role'] !== 'admin') {

                $this->data = App::$db->getRowsWhere('pizzas');

                foreach ($this->data as $pizza_index => $pizza) {

                    $this->orderForm = new OrderForm($pizza_index);
                    $this->data[$pizza_index]['order_button'] = $this->orderForm->render();
                }
                // TODO: Implement index() method.
                $content = new View([
                    'pizzas' => $this->data
                ]);


                $this->page = new BasePage([
                    'title' => 'Pizzas list',
                    'content' => $content->render(ROOT . '/app/templates/content/index.tpl.php')
                ]);
            }
        }
    }

    /**
     * This method builds or sets
     * current $page content
     * renders it and returns HTML
     *
     * So if we have ex.: ProductsController,
     * it can have methods responsible for
     * index() (main page, usualy a list),
     * view() (preview single),
     * create() (form for creating),
     * edit() (form for editing)
     * delete()
     *
     * These methods can then be called on each page accordingly, ex.:
     * add.php:
     * $controller = new PixelsController();
     * print $controller->add();
     *
     *
     * my.php:
     * $controller = new ProductsController();
     * print $controller->my();
     *
     * @return string|null
     */
    public function index(): ?string
    {
//        if (!App::$session->getUser()) {
//            if ($this->form->validate()) {
//                var_dump('asdsaadsdsad');
////                header('Location: /login');
//                exit();
//            }
//        }

        if (App::$session->getUser()) {
            if ($_SESSION['role'] == 'admin') {
                if ($this->form->validate()) {

                    App::$db->deleteRow('pizzas', $_POST['row_id']);

                    header('Location: /');
                    exit();
                }

                if ($this->addForm->validate()) {
                    var_dump($this->addForm->validate());

                    header('Location: /add');
                    exit();
                }
                if ($this->editForm->validate()) {
                    var_dump($this->editForm->validate());

                    header('Location: /edit');
                    exit();
                }
            }
        }

        if (App::$session->getUser() && isset($_GET['order_id'])) {
            if (!$this->orderForm->validate()) {
                App::$db->insertRow('orders', [
                    'email' => $_SESSION['email'],
                    'pizza_id' => $_GET['order_id'],
                    'status' => 'active',
                    'timestamp' => time()
                ]);

                header('Location: /');
            }
        }

        return $this->page->render();
    }
}