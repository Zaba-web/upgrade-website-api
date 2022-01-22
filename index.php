<?php

require_once __DIR__."/vendor/autoload.php";

use App\Services\Routing\Route;
use App\Services\Routing\Router;

$router = new Router([
    Route::GET("/", function(){echo "Hello world";}),
    Route::GET("/post/*/", function($id){echo "Hello world, id is " . $id;})
]);