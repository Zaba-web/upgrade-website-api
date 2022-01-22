<?php

namespace App\Services\Routing;

class Route {
    private static function createRoute($url, $handler, $method) {
        return [
            'url' => $url,
            'handler' => $handler,
            'method' => $method
        ];
    }

    public static function GET($url, $handler) {
        return self::createRoute($url, $handler, "GET");
    }

    public static function POST($url, $handler) {
        return self::createRoute($url, $handler, "POST");
    }
}