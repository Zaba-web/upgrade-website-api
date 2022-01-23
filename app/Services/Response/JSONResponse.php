<?php

namespace App\Services\Response;

class JSONResponse {
    private static function setContentType($type = 'application/json; charset=utf-8') {
        header('Content-Type: '. $type);
    }

    /**
     * Send JSON message as response
     * 
     * @param int $code HTTP response code
     * @param string|array|int $message response message
     */
    public static function message($code, $message) {
        self::setContentType();

        http_response_code($code);
        echo json_encode($message);
    }

    /**
     * Send response to the GET request
     * 
     * @param array $records fetched data from database
     */
    public static function getResponse($records) {
        if($records) {
            JSONResponse::message(202, $records);
        } else {
            JSONResponse::message(204, []);
        }
    }
}