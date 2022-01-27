<?php

namespace App\Models;

use App\Models\Core\Model;

class Roadmap extends Model {
    protected $tableName = 'roadmap';
    protected $model = [
        'item_status' => 0,
        'title' => '',
        'date_str' => '',
        'description' => '',
        'image' => ''
    ];
}