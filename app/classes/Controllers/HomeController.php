<?php
namespace App\Controllers;

use App\app;
use App\Views\BasePage;
use App\Views\Navigation;
use Core\View;

class HomeController extends \App\Abstracts\Controller
{

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
        if (App::$session->getUser()) {
            $data = App::$db->getRowsWhere('items', $conditions = ['id' => $_SESSION['email']]);
        } else {
            $data = App::$db->getRowsWhere('items');
        }
        // TODO: Implement index() method.
        $content = new View([
            'items' => $data
        ]);

        $page = new BasePage([
            'title' => 'Poo-Wall',
            'content' => $content->render(ROOT . '/app/templates/content/index.tpl.php')
        ]);

        return $page->render();
    }
}