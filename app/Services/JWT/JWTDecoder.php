<?php

namespace App\Services\JWT;

use App\Services\JWT\Base64URL;

class JWTDecoder {

    /**
     * Decode JWT
     * 
     * @param string $tokenString token to decode
     * @return array|bool if token is verified then array with following structure: 
     * [
     *  header => string,
     *  payload => string
     * ]
     * or false if it is not
     */
    public static function encode($tokenString) {
        $verifier = new JWTVerifier;

        if(!$verifier->verify($tokenString)) {
            return false;
        }

        return self::getTokenParts($tokenString);
    }

    /**
     * Convert string with JWT into array
     * 
     * @param string $tokenString token
     * @return array with following structure: [
     *  header => string,
     *  payload => string
     * ]
     */
    private static function getTokenParts($tokenString) {
        $tokenParts = explode('.', $tokenString);

        $header = Base64URL::decode($tokenParts[0]);
        $payload = Base64URL::decode($tokenParts[1]);

        return [
            "header" => $header,
            "payload" => $payload
        ];
    }
}