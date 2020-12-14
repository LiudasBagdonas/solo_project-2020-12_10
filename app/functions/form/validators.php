<?php

use App\App;

/**
 * Check if login is successful. Input values must match values in credentials array.
 *
 * @param $form_values
 * @param array $form
 * @return bool
 */
function validate_login($form_values, array &$form): bool
{
//    $db = new FileDB(DB_FILE);
//    $db->load();
    $credentials = App::$db->getRowWhere('users',
        ['email' => $form_values['email'], 'password' => $form_values['password']]);

    if (App::$db->getRowWhere('users', [
        'email' => $form_values['email'],
        'password' => $form_values['password']])) {
        return true;
    }

    $form['error'] = 'Unable to login: check your email and/or password';

    return false;
}

/**
 * Check if email is available for registration, i.e. if it is not already taken
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_user_unique(string $field_value, array &$field): bool
{

    if (App::$db->tableExists('users')) {
        $email_taken = App::$db->getRowWhere('users', ['email' => $field_value]);
        if ($email_taken) {
            $field['error'] = 'Email is already taken: enter new email.';

            return false;
        }

        return true;
    }

    return true;
}
function redirect($field_value, array &$field)
{
    return true;
}

function order($field_value, array &$field)
{
    var_dump($field_value);
    return true;
}
