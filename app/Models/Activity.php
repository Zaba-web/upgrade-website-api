<?php

namespace App\Models;

use App\Models\Core\Model;

class Activity extends Model {
    protected $tableName = 'activities';
    protected $model = [
        'type' => 0,
        'title' => '',
        'description' => '',
        'big_image' => '',
        'small_image' => ''
    ];
}