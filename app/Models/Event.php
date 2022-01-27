<?php

namespace App\Models;

use App\Models\Core\Model;

class Event extends Model {
    protected $tableName = 'events';
    protected $model = [
        'type' => 0,
        'date_str' => '',
        'title' => '',
        'description' => '',
        'image' => ''
    ];
}