<?php


namespace App\Controllers;

use App\App;
use Core\FileDB;

class InstallController
{
    public function install()
    {
        App::$db = new FileDB(DB_FILE);
        App::$db->createTable('credentials');
        App::$db->insertRow('credentials', ['email' => 'liudasbagd@gmail.com', 'password' => 'qq']);
        App::$db->createTable('items');
        App::$db->createTable('history');
    }
}