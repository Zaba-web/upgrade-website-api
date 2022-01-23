<?php

namespace App\Models;

use App\Models\Core\Model;

class News extends Model {
    protected $tableName = 'news';
    protected $model = [
        'date' => '',
        'title' => '',
        'photo' => '',
        'text' => '',
        'views' => 0,
        'created_at' => null
    ];
}