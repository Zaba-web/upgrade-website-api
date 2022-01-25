<?php

namespace App\Services\Validation\Rules;

abstract class Rule {
    protected $dataToValidate;
    protected $messageIfInvdalid;

    public function __construct($dataToValidate, $messageIfInvdalid) {
        $this->dataToValidate = $dataToValidate;
        $this->messageIfInvdalid = $messageIfInvdalid;
    }

    abstract public function validate($requirements);

    protected function getResult($result){
        return [
            'isValid' => $result,
            'message' => $this->messageIfInvdalid 
         ];
    }
}