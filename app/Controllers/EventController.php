<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\Event;
use App\Services\Response\JSONResponse;

class EventController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new Event();
    }

    public function create() {
        $validationResult = $this->validateNotEmpty($_POST['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_POST['announce'], $_POST['type'], $_POST['active'], $_POST['date_str'], $_POST['title'], $_POST['description'], $_POST['image']]);

        $result = $this->Model->create($model);
        JSONResponse::POSTResponse($result);
    }

    public function update($id) {
        $_PUT = $this->getPutData();

        $validationResult = $this->validateNotEmpty($_PUT['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_PUT['announce'], $_PUT['type'], $_PUT['active'], $_PUT['date_str'], $_PUT['title'], $_PUT['description'], $_PUT['image']]);

        $result = $this->Model->updateById($id, $model);
        JSONResponse::DefaultSuccessResponse($result);
    }
}