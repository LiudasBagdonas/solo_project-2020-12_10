<?php

namespace App;

use Core\FileDB;
use Core\Session;
use App\Tracker;
use Core\Router;


class App
{
    public static FileDB $db;
    public static Session $session;
    public static Tracker $tracker;
    public static Router $router;

    public function __construct()
    {
        self::$db = new FileDB(DB_FILE);
        self::$db->load();

        self::$session = new Session();
        self::$tracker = new Tracker();
        self::$router = new Router();
    }

    public function run()
    {
        print self::$router::run();
    }

    public function __destruct()
    {
        self::$db->save();
    }
}