<?php

use App\Services\Routing\Route;
use App\Controllers\NewsController;

$routes = [
    Route::GET('/news', function(){
        $newsController = new NewsController();
        $newsController->getAllRecords();
    }),
    Route::GET('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->getById($id);
    }),
    Route::POST('/news', function(){
        $newsController = new NewsController();
        $newsController->create();
    }),
    Route::DELETE('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->delete($id);
    }),
    Route::PUT('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->update($id);
    })
];