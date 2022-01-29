<?php

namespace App\Models;

use App\Models\Core\Model;
use App\Database\DB;

class TeamMember extends Model {
    protected $tableName = 'team';
    protected $model = [
        'type' => 0,
        'name' => '',
        'biography' => '',
        'photo' => ''
    ];

    protected $MAIN_MEMBER = 1;
    protected $MENTOR = 2;
    protected $ASSISTANCE = 3;

    private function returnResult($queryResult) {
        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }

    public function getMainMembers() {
        $queryResult = DB::GetInstance()->query("SELECT * FROM " . $this->tableName . " WHERE type = '$this->MAIN_MEMBER'");
        return $this->returnResult($queryResult);
    }

    public function getMentor() {
        $queryResult = DB::GetInstance()->query("SELECT * FROM " . $this->tableName . " WHERE type = '$this->MENTOR'");
        return $this->returnResult($queryResult);
    }

    public function getAssistance() {
        $queryResult = DB::GetInstance()->query("SELECT * FROM " . $this->tableName . " WHERE type = '$this->ASSISTANCE'");
        return $this->returnResult($queryResult);
    }
}