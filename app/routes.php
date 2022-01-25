<?php

use App\Services\Routing\Route;
use App\Controllers\NewsController;
use App\Services\Validation\Rules\MinLength;

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

    // Route::DECLARE('/test', function(){
    //     $r = new MinLength("tes");
    //     var_dump($r->validate(3));
    // }, "GET")
];