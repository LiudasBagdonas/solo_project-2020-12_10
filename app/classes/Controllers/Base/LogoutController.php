<?php


namespace App\Controllers\Base;

use App\App;

class LogoutController extends AuthController
{
    public function logout()
    {
        App::$tracker->savePageVisit();
        App::$session->logout('login');

        return;
    }
}