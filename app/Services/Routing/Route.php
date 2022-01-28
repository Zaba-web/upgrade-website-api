<?php

namespace App\Services\Routing;

class Route {
    public static function Declare($url, $handler, $method, $accessRestriction = false) {
        return [
            'url' => $url,
            'handler' => $handler,
            'method' => $method,
            'accessRestriction' => $accessRestriction
        ];
    }
}