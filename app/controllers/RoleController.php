<?php

namespace App\controllers;

use App\models\RoleModel;

class RoleController extends Controller {

    public function getRoles () {
        if (!$this->isLoggedIn()) {
            return $this->response(401, null, 'Unauthorized!');
        }

        $role_model = new RoleModel();
        $roles = $role_model->findAll();

        return $this->response(200, $roles);
    }

}