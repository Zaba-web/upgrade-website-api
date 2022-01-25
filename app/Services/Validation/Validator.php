<?php

namespace App\Services\Validation;

class Validator {
    public static function Validate($rules) {
        $resultMessages = [];
        $result = true;

        foreach($rules as $rule) {
            if(!$rule->isValid) {
                $result = false;
                $resultMessages[] = $rule->message;
            }
        }

        return [
            "isValid" => $result,
            "messages" => $resultMessages
        ];
    }
}