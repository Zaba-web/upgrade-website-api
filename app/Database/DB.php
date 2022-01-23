<?php

namespace App\Database;

use mysqli;

class DB {
    static private $DBInstance = null;

    /**
     * Get instance of DB connection (singleton)
     * 
     * @return object MySQLi object
     */
    static public function GetInstance(){
        if(self::$DBInstance == null) {
            self::createInstance();
        }

        return self::$DBInstance;
    }

    /**
     * Create instance of MySQLi if it not created yet
     */
    private static function createInstance() {
        require_once __DIR__."/config.php";

        self::$DBInstance = new mysqli(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['database']
        );

        if(self::$DBInstance->connect_errno > 0) {
            trigger_error($db->connect_error);
        }
    }

    /**
     * Get query results as associative array.
     * 
     * @param object $queryResult result of SQL query
     * @return array query result as array
     */
    public static function FetchResult($queryResult) {
        $result = [];

        while ($row = $queryResult->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }
}