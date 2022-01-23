<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\News;
use App\Services\Response\JSONResponse;

class NewsController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new News();
    }
}