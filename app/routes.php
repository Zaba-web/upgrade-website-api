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
    Route::GET('/', function(){
        echo "Hello";
    })
];