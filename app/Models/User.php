<?php

namespace App\Models;

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
}