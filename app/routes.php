<?php

use App\Services\Routing\Route;
use App\Controllers\NewsController;

$routes = [
    Route::DECLARE('/news', function(){
        $newsController = new NewsController();
        $newsController->getAllRecords();
    }, "GET"),
    Route::DECLARE('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->getById($id);
    }, "GET"),
    Route::DECLARE('/news', function(){
        $newsController = new NewsController();
        $newsController->create();
    }, "POST"),
    Route::DECLARE('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->delete($id);
    }, "DELETE"),
    Route::DECLARE('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->update($id);
    }, "PUT")
];