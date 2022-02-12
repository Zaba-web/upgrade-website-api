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
    public function getAll($order = "DESC") {
        $queryResult = DB::GetInstance()->query('SELECT * FROM ' . $this->tableName . ' ORDER BY id '.$order);

        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }

    public function getSeparate($query, $order = "DESC") {
        $queryResult = DB::GetInstance()->query('SELECT ' . $query . ' FROM ' . $this->tableName . ' ORDER BY id '.$order);
        
        if($queryResult) { 
            return DB::FetchResult($queryResult);
        }

        return false;
    }

    /**
     * Get limited count of records
     * 
     * @param string $order
     * @param int $count
     */
    public function getLimited($count, $order = "DESC") {
        $queryResult = DB::GetInstance()->query('SELECT * FROM ' . $this->tableName . " ORDER BY id " . $order . " LIMIT " . $count);

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
        $columnNames = $this->getModelKeys($model);
        $valuesToString = $this->getModelValues($model);

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

    /**
     * Update record in table
     * 
     * @param int $_id id of record
     * @param array $model new record state 
     */
    public function updateById($_id, $model) {
        $id = DB::GetInstance()->real_escape_string($_id);
        
        $keys = $this->getModelKeys($model, false);
        $values = $this->getModelValues($model, false);

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
     * If $preperedForQuery get array of model keys
     * Else get string prepared to query "columnName1, columnName2..."
     * 
     * @param array $model model of new record
     * @param bool $preperedForQuery implode in string with ', ' delimited if true
     * 
     * @return string|array<string> if $preperedForQuery is true it is a string, else array
     */
    private function getModelKeys($model, $preperedForQuery = true) {
        $keys = array_keys($model);

        for($i = 0; $i < count($keys); $i++) {
            $keys[$i] = DB::GetInstance()->real_escape_string($keys[$i]);
        }

        if(!$preperedForQuery) {
            return $keys;
        }

        return implode(', ', $keys);
    }

    /**
     * If $preperedForQuery is true get array of model values
     * Else get string prepared to query "'value1', 'value2'..."
     * 
     * @param array $model model of new record
     * @param bool $preperedForQuery implode in string with ', ' delimited if true
     * 
     * @return string|array<string> if $preperedForQuery is true it is a string, else array
     */
    private function getModelValues($model, $preperedForQuery = true) {
        $values = array_values($model);

        for($i = 0; $i < count($values); $i++) {
            $values[$i] = DB::GetInstance()->real_escape_string($values[$i]);
            $values[$i] = "'".$values[$i]."'";
        }

        if(!$preperedForQuery) {
            return $values;
        }

        return implode(', ', $values);
    }
}