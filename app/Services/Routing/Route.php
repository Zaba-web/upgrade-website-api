<?php

namespace App\Services\Routing;

class Route {
    public static function DECLARE($url, $handler, $method) {
        return [
            'url' => $url,
            'handler' => $handler,
            'method' => $method
        ];
    }
}