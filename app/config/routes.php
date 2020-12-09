<?php

use Core\Router;

Router::add('index', '/', '\App\Controllers\HomeController');
Router::add('index2', '/index', '\App\Controllers\HomeController');

Router::add('login', '/login', '\App\Controllers\LoginController', 'login');
Router::add('register', '/register', '\App\Controllers\RegisterController', 'register');
Router::add('home', '/index', '\App\Controllers\HomeController', 'index');
Router::add('add', '/admin/add', '\App\Controllers\Admin\AddController', 'add');
Router::add('edit', '/admin/edit', '\App\Controllers\Admin\EditController', 'edit');
Router::add('list', '/admin/list', '\App\Controllers\Admin\ListController', 'list');
Router::add('logout', '/logout', '\App\Controllers\Base\LogoutController', 'logout');

Router::add('install', '/install', '\App\Controllers\InstallController', 'install');