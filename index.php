<?php
 use App\App;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
} 

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/app/routes.php";

$app = new App();

$app->setupRouter($routes);

