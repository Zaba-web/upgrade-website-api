<?php

namespace App;

use App\Services\Routing\Router;

class App {
    public function setupRouter($routes) {
        new Router($routes);
        return $this;
    }
}