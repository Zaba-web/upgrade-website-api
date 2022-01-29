<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\Roadmap;
use App\Services\Response\JSONResponse;

class RoadmapController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new Roadmap();
    }

    public function create() {
        $validationResult = $this->validateNotEmpty($_POST['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_POST['item_status'], $_POST['date_str'], $_POST['title'], $_POST['description'], $_POST['image']]);

        $result = $this->Model->create($model);
        JSONResponse::POSTResponse($result);
    }

    public function update($id) {
        $_PUT = $this->getPutData();

        $validationResult = $this->validateNotEmpty($_PUT['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_PUT['item_status'], $_PUT['date_str'], $_PUT['title'], $_PUT['description'], $_PUT['image']]);

        $result = $this->Model->updateById($id, $model);
        JSONResponse::DefaultSuccessResponse($result);
    }

    public function getAllRecords() {
        $allRecords = $this->Model->getAll("ASC");
        JSONResponse::GETResponse($allRecords);
    }
}