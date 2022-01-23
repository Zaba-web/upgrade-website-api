<?php

namespace App\Models\Core;

use App\Database\DB;

abstract class Model {
    protected $tableName = "";
    protected $model = [];

    /**
     * Create model with data for new record
     * 
     * @param array $parameters values for new record
     * 
     * @return array model with values
     */
    public function getModel($parameters) {
        $model = [];
        $keys = array_keys($this->model);

        for($i = 0; $i < count($keys); $i++) {
            $model[$keys[$i]] = $parameters[$i];
        }

        return $model;
    }

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
     * Get single record by id
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

    /**
     * Create record
     * 
     * @param array $model model of the record
     * 
     * @return bool
     */
    public function create($model) {
        $modelData = $this->handleInputModel($model);
        $columnNames = $modelData[0];
        $valuesToString = $modelData[1];

        $queryString = "INSERT INTO " . $this->tableName . "(" . $columnNames . ") VALUES (" . $valuesToString . ")";

        $queryResult = DB::GetInstance()->query($queryString);

        if($queryResult) {
            return true;
        } 

        return false;
    }

    /**
     * Delete record by ID
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function deleteById($_id) {
        $id = DB::GetInstance()->real_escape_string($_id);

        $queryResult = DB::GetInstance()->query("DELETE FROM " . $this->tableName . " WHERE id = '$id'");

        if($queryResult) {
            return true;
        } 

        return false;
    }

    public function updateById($_id, $model) {
        $id = DB::GetInstance()->real_escape_string($_id);
        $modelData = $this->handleInputModel($model, false);
        $keys = $modelData[0];
        $values = $modelData[1];

        $updateArray = [];
        
        for($i = 0; $i < count($keys); $i++) {
            $updateArray[] = $keys[$i] . "=" . $values[$i];
        }

        $resultString = implode(",", $updateArray);

        $queryString = "UPDATE " . $this->tableName . " SET " . $resultString . " WHERE id = '$id'";

        $queryResult = DB::GetInstance()->query($queryString);

        if($queryResult) {
            return true;
        } 

        return false;
    }

    /**
     * Get data ready to insert into DB
     * 
     * @param array $model model of the record
     */
    private function handleInputModel($model, $implodeInString = true) {
        $keys = array_keys($model);
        $values = array_values($model);

        for($i = 0; $i < count($values); $i++) {
            $keys[$i] = DB::GetInstance()->real_escape_string($keys[$i]);
            $values[$i] = DB::GetInstance()->real_escape_string($values[$i]);
            $values[$i] = "'".$values[$i]."'";
        }

        if($implodeInString) {
            $columnNames = implode(', ', $keys);
            $valuesToString = implode(', ', $values);

            return [$columnNames, $valuesToString];
        } else {
            return [$keys, $values];
        }
    }
}