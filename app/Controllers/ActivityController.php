<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\Activity;
use App\Services\Response\JSONResponse;

class ActivityController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new Activity();
    }

    public function create() {
        $validationResult = $this->validateNotEmpty($_POST['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_POST['type'], $_POST['title'], $_POST['description'], $_POST['big_image'], $_POST['small_image']]);

        $result = $this->Model->create($model);
        JSONResponse::POSTResponse($result);
    }

    public function update($id) {
        $_PUT = $this->getPutData();

        $validationResult = $this->validateNotEmpty($_PUT['title'], "Заголовок");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_PUT['type'], $_PUT['title'], $_PUT['description'], $_PUT['big_image'], $_PUT['small_image']]);

        $result = $this->Model->updateById($id, $model);
        JSONResponse::POSTResponse($result);
    }
}