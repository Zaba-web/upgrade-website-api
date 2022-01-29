<?php

namespace App\Controllers\Core;

use App\Controllers\Core\Controller;
use App\Services\Response\JSONResponse;

use App\Services\Validation\Validator;
use App\Services\Validation\Rules\MinLength;
use App\Services\Validation\Rules\MaxLength;

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
     * Get limited count of records
     */
    public function getLimited($limit) {
        $allRecords = $this->Model->getLimited($limit);
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

    /**
     * Delete record by id
     * 
     * @param int $id
     */
    public function delete($id) {
        $result = $this->Model->deleteById($id);
        return JSONResponse::DefaultSuccessResponse($result);
    }

    /**
     * Since PUT does not support form-data, it need to be parsed from JSON
     * 
     * @return array
     */
    protected function getPutData() {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * Check if string is not empty
     * 
     * @param $string string to check
     * @return bool result
     */
    protected function validateNotEmpty($string, $paramName) {
        return Validator::Validate([
            (new MinLength($string, $paramName . " не може бути порожнім"))->validate(1),
            (new MaxLength($string, $paramName . " не може бути більшим за 255 символів"))->validate(255)
        ]);
    }
}