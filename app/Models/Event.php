<?php

namespace App\Models;

use App\Models\Core\Model;

class Event extends Model {
    protected $tableName = 'events';
    protected $model = [
        'announce' => '',
        'type' => '',
        'active' => 0,
        'date_str' => '',
        'title' => '',
        'description' => '',
        'image' => ''
    ];
}