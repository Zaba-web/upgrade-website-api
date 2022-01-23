<?php

namespace App\Models\Core;

use App\Database\DB;

abstract class Model {
    protected $tableName = "";

    /**
     * Get all records
     * 
     * @return object result if something found
     * @return false if nothing was found
     */
    public function getAll() {
        $queryResult = DB::GetInstance()->query('SELECT * FROM ' . $this->tableName);

        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }

    /**
     * Get one record by id
     * 
     * @return object result if something found
     * @return false if nothing was found
     */
    public function getById($_id) {
        $id = DB::GetInstance()->real_escape_string($_id);
        $queryResult = DB::GetInstance()->query("SELECT * FROM " . $this->tableName . " WHERE id='$id'");

        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }
}