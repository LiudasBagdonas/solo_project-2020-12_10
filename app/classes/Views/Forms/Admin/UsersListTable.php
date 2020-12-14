<?php


namespace App\Views\Forms\Admin;

use App\App;
use Core\Views\Table;

class UsersListTable extends Table
{
    protected $data;
    protected $statusTable;
    protected $form;


    public function __construct()
    {
        $users = App::$db->getRowsWhere('users');
        $curent_user = App::$db->getRowWhere('users', $condition = ['email' => $_SESSION['email']]);

        foreach ($users as $user_id => $user) {

            if ($user['email'] != $_SESSION['email']) {
                $this->form = new UsersListForm($user_id);
                $this->form->fill(App::$db->getRowById('users', $user_id));

                $this->data[$user_id] = [

                    'id' => $user_id,
                    'name' => $user['username'],
                    'role' => $this->form->render()
                ];
            }
//            $this->form->fill(App::$db->getRowById('users', $order_id));

        }

        parent::__construct([
            'data' => $this->data,
            'headers' => ['ID', 'Name', 'Role']
        ]);


        if ($this->form->validate()) {
            $row = App::$db->getRowById('users', $_POST['user_id']);
            $row['role'] = $_POST['role'];

            App::$db->updateRow('users', $row, $_POST['user_id']);
            header('Location: /userslist');
        }
    }

}