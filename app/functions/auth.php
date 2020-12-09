<?php

use App\App;

/**
 * Check if user is Logged In
 * @return bool
 */
function is_logged_in(): bool
{

    if ($_SESSION) {
        return (bool)App::$db->getRowWhere('credentials', [
            'email' => $_SESSION['email'],
            'password' => $_SESSION['password']]);
    }

    return false;
}

/**
 * Function ends the session
 *
 * @param null $redirect
 */
function logout($redirect = null): void
{
    $_SESSION = [];
    session_destroy();
    if ($redirect) {
        header("Location: $redirect");
    }
}