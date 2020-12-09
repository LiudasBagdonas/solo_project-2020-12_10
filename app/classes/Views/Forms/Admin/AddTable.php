<?php


namespace App\Views\Forms\Admin;

use App\App;
use Core\Views\Table;

class AddTable extends Table
{

    public function __construct()
    {
        parent::__construct([
            'data' => App::$db->getRowsWhere('items', $conditions = ['id' => $_SESSION['email']]),
            'headers' => ['X axes', 'Y axes', 'Color']
            ]);
    }
}