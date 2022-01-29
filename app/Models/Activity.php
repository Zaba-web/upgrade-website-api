<?php

namespace App\Models;

use App\Models\Core\Model;
use App\Database\DB;

class Activity extends Model {
    protected $tableName = 'activities';
    protected $model = [
        'type' => 0,
        'title' => '',
        'description' => '',
        'big_image' => '',
        'small_image' => ''
    ];

    public function getByType($type) {
        $queryResult = DB::GetInstance()->query("SELECT * FROM " . $this->tableName . " WHERE type = '$type' ORDER BY id  DESC");

        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }
}