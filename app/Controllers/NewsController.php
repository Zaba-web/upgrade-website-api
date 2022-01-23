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

    public function update($id) {
        $_PUT = json_decode(file_get_contents('php://input'), true);

        $model = [
            'date' => $_PUT['date'],
            'title' => $_PUT['title'],
            'photo' => $_PUT['photo'],
            'text' => $_PUT['text'],
            'views' => $_PUT['views'],
            'created_at' => date("Y-m-d H:i:s")
        ];

        $result = $this->Model->updateById($id, $model);
        JSONResponse::DefaultSuccessResponse($result);
    }
}