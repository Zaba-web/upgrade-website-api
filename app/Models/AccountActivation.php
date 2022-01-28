<?php

namespace App\Models;

use App\Models\Core\Model;
use App\Database\DB;

class AccountActivation extends Model {
    protected $tableName = 'account_avtication';
    protected $model = [
        'user_id' => 0,
        'hash' => '',
        'activated' => 0
    ];

    public function getByHash($_hash) {
        $hash = DB::GetInstance()->real_escape_string($_hash);
        $queryResult = DB::GetInstance()->query("SELECT * FROM " . $this->tableName . " WHERE hash='$hash'");

        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }
}