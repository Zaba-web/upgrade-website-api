<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\AccountActivation;
use App\Services\Response\JSONResponse;

class AccountActivationController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new AccountActivation();
    }

    public function create($user_id, $hash) {
        $model = $this->Model->getModel([$user_id, $hash, 0]);
        return $this->Model->create($model);
    }

    public function getByHash($hash) {
        return $this->Model->getByHash($hash);
    }
}