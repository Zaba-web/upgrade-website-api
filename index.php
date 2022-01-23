<?php

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/app/routes.php";

use App\App;

$app = new App();

$app->setupRouter($routes);