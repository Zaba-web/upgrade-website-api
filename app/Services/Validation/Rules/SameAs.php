<?php

namespace App\Services\Validation\Rules;

use App\Services\Validation\Rules\Rule;

class SameAs extends Rule{
    /**
     * Validate if two strings are the same
     * 
     * @param string $requirements string to check
     * @return array Array with validation status and error message 
     * [
     *  isValid => bool,
     *  message => string
     * ]
     */
    public function validate($requirements) {
        return $this->getResult($this->dataToValidate == $requirements);
    }
}