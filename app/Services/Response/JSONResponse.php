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
    public static function GETResponse($records) {
        if($records) {
            JSONResponse::message(202, $records);
        } else {
            JSONResponse::message(204, []);
        }
    }

    /**
     * Send response to the POST request
     * 
     * @param bool $result result of create operation
     */
    public static function POSTResponse($result) {
        if($result) {
            JSONResponse::message(201, []);
        } else {
            JSONResponse::message(400, []);
        }
    }

    /**
     * Send response with code 200 if succeed or 520 if failed
     * 
     * @param bool $result result of create operation
     */
    public static function DefaultSuccessResponse($result) {
        if($result) {
            JSONResponse::message(200, []);
        } else {
            JSONResponse::message(520, []);
        }
    }
}