<?php

namespace App\Models;

use App\Database\DB;
use App\Models\Core\Model;

class User extends Model {
    protected $tableName = 'users';
    protected $model = [
        'access_level' => 0,
        'active' => 0,
        'name' => '',
        'email' => '',
        'password' => ''
    ];

    public function getUser($_email, $password) {
        $email = DB::GetInstance()->real_escape_string($_email);
        $queryResult = DB::GetInstance()->query("SELECT * FROM users WHERE email = '$email'");

        if(!$queryResult) {
            return false;
        }

        $user = DB::FetchResult($queryResult)[0];

        if(password_verify($password, $user['password']) && $user['active'] != 0) {
            return $user;
        }

        return false;
    }
}