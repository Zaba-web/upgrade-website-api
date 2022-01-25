<?php

namespace App\Services\Validation\Rules;

use App\Services\Validation\Rules\Rule;

class MinLength extends Rule{
    /**
     * Validate string minimal length
     * 
     * @param int $requirements minimal length of string
     * @return array Array with validation status and error message 
     * [
     *  isValid => bool,
     *  message => string
     * ]
     */
    public function validate($requirements) {
        return $this->getResult(strlen($this->dataToValidate) >= $requirements);
    }
}