<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\News;
use App\Services\Response\JSONResponse;

class NewsController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new News();
    }

    public function create() {
        $model = $this->Model->getModel([
            $_POST['date'],
            $_POST['title'],
            $_POST['photo'],
            $_POST['text'],
            0,
            date("Y-m-d H:i:s")
        ]);

        $result = $this->Model->create($model);
        JSONResponse::POSTResponse($result);
    }

    public function getById($id) {
        $record = $this->Model->getById($id);
        JSONResponse::GETResponse($record);

        $model = $this->increaseViewsCounter($record[0]);

        $this->Model->updateById($id, $model);
    }

    public function update($id) {
        $_PUT = $this->getPutData();
        
        $model = $this->Model->getModel([
                $_PUT['date'],
                $_PUT['title'],
                $_PUT['photo'],
                $_PUT['text'],
                $_PUT['views'],
                date("Y-m-d H:i:s")
        ]);

        $result = $this->Model->updateById($id, $model);
        JSONResponse::DefaultSuccessResponse($result);
    }

    private function increaseViewsCounter($record) {
        $recordForModel = array_values($record);
        array_shift($recordForModel);

        $model = $this->Model->getModel($recordForModel);
        $model['views'] += 1;

        return $model;
    }
}