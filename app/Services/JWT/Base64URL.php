<?php

namespace App\Services\JWT;

class Base64URL {
    public static function encode($string) {
        $b64 = base64_encode($string);

        if ($b64 === false) {
            return false;
        }

        $url = strtr($b64, '+/', '-_');

        return rtrim($url, '=');
    }

    public static function decode($data) {
        $b64 = strtr($data, '-_', '+/');
        return base64_decode($b64);
    }
}