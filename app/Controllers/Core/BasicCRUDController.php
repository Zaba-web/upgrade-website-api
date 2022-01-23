<?php

namespace App\Controllers\Core;

use App\Controllers\Core\Controller;
use App\Services\Response\JSONResponse;

class BasicCRUDController extends Controller {
    protected $Model = null;

    /**
     * Get all records from database for corresponding model
     */
    public function getAllRecords() {
        $allRecords = $this->Model->getAll();
        JSONResponse::getResponse($allRecords);
    }

    /**
     * Get single record by id
     */
    public function getById($id) {
        $record = $this->Model->getById($id);
        JSONResponse::getResponse($record);
    }
}