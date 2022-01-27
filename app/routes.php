<?php

use App\Services\Routing\Route;
use App\Controllers\NewsController;
use App\Controllers\RegisterController;

$routes = [
    Route::Declare('/news', function(){
        $newsController = new NewsController();
        $newsController->getAllRecords();
    }, "GET"),

    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->getById($id);
    }, "GET"),

    Route::Declare('/news', function(){
        $newsController = new NewsController();
        $newsController->create();
    }, "POST"),

    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->delete($id);
    }, "DELETE"),
    
    Route::Declare('/news/*', function($id){
        $newsController = new NewsController();
        $newsController->update($id);
    }, "PUT"),

    Route::Declare('/register', function(){
        $registerController = new RegisterController();
        $registerController->create();
    }, "POST")
];