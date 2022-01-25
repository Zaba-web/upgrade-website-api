<?php

namespace App\Services\Routing;

class Route {
    public static function Declare($url, $handler, $method) {
        return [
            'url' => $url,
            'handler' => $handler,
            'method' => $method
        ];
    }
}