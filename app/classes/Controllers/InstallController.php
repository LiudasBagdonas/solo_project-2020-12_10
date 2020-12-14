<?php


namespace App\Controllers;

use App\App;
use Core\FileDB;

class InstallController
{
    public function install()
    {
        App::$db = new FileDB(DB_FILE);
        App::$db->createTable('users');
        App::$db->insertRow('users', ['email' => 'liudasbagd@gmail.com', 'password' => 'qq', 'role' => 'admin']);
        App::$db->createTable('pizzas');
        App::$db->createTable('orders');
        var_dump('Installed');
    }
}