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
    $credentials = App::$db->getRowWhere('credentials',
        ['email' => $form_values['email'], 'password' => $form_values['password']]);

    if (App::$db->getRowWhere('credentials', [
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

    if (App::$db->tableExists('credentials')) {
        $email_taken = App::$db->getRowWhere('credentials', ['email' => $field_value]);
        if ($email_taken) {
            $field['error'] = 'Email is already taken: enter new email.';

            return false;
        }

        return true;
    }

    return true;
}

/**
 * Check if coordinate is not taken and coordinates are in appropriate range.
 * @param $form_values
 * @param array $form
 * @return bool
 */

function validate_coordinates_overlap($form_values, array &$form): bool
{

    $db_data = App::$db->getData();
    $result = true;

    if (!strpbrk($form_values['xaxes'], '1234567890') || !strpbrk($form_values['yaxes'], '1234567890')) {
        $form['error'] = 'Nothing entered';

        return false;
    }

    if (($form_values['xaxes'] < 0 || $form_values['xaxes'] > 490) ||
        ($form_values['yaxes'] < 0 || $form_values['yaxes'] > 490)) {

        $form['error'] = 'Coordinates must be between 0 and 490';
        return false;
    }

    if (isset($db_data['items']) && count($db_data['items']) > 0) {
        foreach ($db_data['items'] as $item_index => $item) {
            $xaxes = $item['xaxes'] - $form_values['xaxes'];
            $yaxes = $item['yaxes'] - $form_values['yaxes'];

            if (isset($_GET['id'])) {
                if ($item_index == $_GET['id']) {
                    return true;
                }
            }
            if ($xaxes <= -10 || $xaxes >= 10) {
                $result = true;
            } else if ($yaxes <= -10 || $yaxes >= 10) {
                $result = true;
            } else {
                $form['error'] = 'Coordinates taken';

                return false;
            }

        }
    }
    if ($result) {
        return true;
    }
    $form['error'] = 'Coordinates taken';

    return false;
}