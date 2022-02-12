<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\Publication;
use App\Services\Response\JSONResponse;

class PublicationController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new Publication();
    }

    public function create() {
        $validationResult = $this->validateNotEmpty($_POST['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_POST['activity_id'], $_POST['title'], $_POST['description'], $_POST['image'], $_POST['text']]);
        
        $result = $this->Model->create($model);
        JSONResponse::POSTResponse($result);
    }

    public function update($id) {
        $_PUT = $this->getPutData();

        $validationResult = $this->validateNotEmpty($_PUT['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_PUT['activity_id'], $_PUT['title'], $_PUT['description'], $_PUT['image'], $_PUT['text']]);
        
        $result = $this->Model->updateById($id, $model);
        JSONResponse::DefaultSuccessResponse($result);
    }

    public function getByActivityId($id, $query = "*") {
        $records = $this->Model->getByActivityId($id, $query);
        JSONResponse::GETResponse($records);
    }
}