<?php

namespace App\Models;

use App\Models\Core\Model;

class User extends Model {
    protected $tableName = 'user';
    protected $model = [
        'id' => '',
        'access_level' => 0,
        'name' => '',
        'email' => '',
        'password' => ''
    ];
}