<?php

namespace App\Models;

use App\Database\DB;
use App\Models\Core\Model;

class Publication extends Model {
    protected $tableName = 'publications';
    protected $model = [
        'activity_id' => 0,
        'title' => '',
        'description' => '',
        'image' => '',
        'text' => ''
    ];

    public function getByActivityId($_id) {
        $id = DB::GetInstance()->real_escape_string($_id);
        $queryResult = DB::GetInstance()->query("SELECT * FROM " . $this->tableName . " WHERE activity_id='$id'");
    
        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }
}