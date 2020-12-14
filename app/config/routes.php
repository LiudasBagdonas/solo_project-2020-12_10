<?php

use Core\Router;

Router::add('index', '/', '\App\Controllers\HomeController');
Router::add('index2', '/index', '\App\Controllers\HomeController');

Router::add('login', '/login', '\App\Controllers\LoginController', 'login');
Router::add('register', '/register', '\App\Controllers\RegisterController', 'register');
Router::add('home', '/index', '\App\Controllers\HomeController', 'index');
Router::add('my_orders', '/myorders', '\App\Controllers\UserOrdersController', 'myOrders');

Router::add('users_list', '/userslist', '\App\Controllers\Admin\UsersListController', 'usersList');
Router::add('edit', '/edit', '\App\Controllers\Admin\EditController', 'edit');
Router::add('add', '/add', '\App\Controllers\Admin\AddController', 'add');
Router::add('admin_order', '/admin/order', '\App\Controllers\Admin\AdminOrderController', 'adminOrder');

Router::add('logout', '/logout', '\App\Controllers\Base\LogoutController', 'logout');

Router::add('install', '/install', '\App\Controllers\InstallController', 'install');