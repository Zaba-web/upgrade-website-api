<?php

namespace App\Controllers\Core;

use App\Controllers\Core\Controller;
use App\Services\Response\JSONResponse;

abstract class BasicCRUDController implements Controller {
    protected $Model = null;

    /**
     * Get all records from database for corresponding model
     */
    public function getAllRecords() {
        $allRecords = $this->Model->getAll();
        JSONResponse::GETResponse($allRecords);
    }

    /**
     * Get single record by id
     * 
     * @param int $id
     */
    public function getById($id) {
        $record = $this->Model->getById($id);
        JSONResponse::GETResponse($record);
    }

    public function delete($id) {
        $result = $this->Model->deleteById($id);
        JSONResponse::DefaultSuccessResponse($result);
    }
}