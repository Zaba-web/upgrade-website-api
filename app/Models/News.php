<?php

namespace App\Models;

use App\Models\Core\Model;
use App\Database\DB;

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

    public function getReadAlso($id) {
        $queryResult = DB::GetInstance()->query('SELECT * FROM ' . $this->tableName . " WHERE id <> '$id' ORDER BY id DESC LIMIT 2");

        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }
}