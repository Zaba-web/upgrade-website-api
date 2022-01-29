<?php

namespace App\Controllers;

use App\Controllers\Core\BasicCRUDController;
use App\Models\TeamMember;
use App\Services\Response\JSONResponse;

class TeamController extends BasicCRUDController {
    public function __construct() {
        $this->Model = new TeamMember();
    }

    public function create() {
        $validationResult = $this->validateNotEmpty($_POST['name'], "Ім'я");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $teamMember = $this->Model->getModel([$_POST['type'], $_POST['name'], $_POST['biography'], $_POST['photo']]);

        $result = $this->Model->create($teamMember);

        JSONResponse::POSTResponse($result);
    }

    public function update($id) {
        $_PUT = $this->getPutData();

        $validationResult = $this->validateNotEmpty($_PUT['name'], "Ім'я");

        if(!$validationResult['isValid']) {
            return JSONResponse::message(406, $validationResult);
        }

        $model = $this->Model->getModel([$_PUT['type'], $_PUT['name'], $_PUT['biography'], $_PUT['photo']]);
    
        $result = $this->Model->updateById($id, $model);
        JSONResponse::DefaultSuccessResponse($result);
    }

    public function getMainMembers() {
        return JSONResponse::GETResponse($this->Model->getMainMembers());
    }

    public function getMentor() {
        return JSONResponse::GETResponse($this->Model->getMentor());
    }

    public function getAssistance() {
        return JSONResponse::GETResponse($this->Model->getAssistance());
    }

}