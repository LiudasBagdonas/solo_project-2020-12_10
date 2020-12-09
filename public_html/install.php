<?php

use App\App;

require '../bootloader.php';

App::$db->createTable('credentials');
App::$db->insertRow('credentials', ['email' => 'test@test.lt', 'password' => 'test']);

App::$db->createTable('items');
App::$db->createTable('history');