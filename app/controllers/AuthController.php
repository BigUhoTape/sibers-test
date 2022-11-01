<?php

namespace App\controllers;

use App\models\LoginForm;

class AuthController extends Controller {

    public function auth () {
        try {
            $post = json_decode(file_get_contents("php://input"), true);

            $login_form = new LoginForm();
            $login_form->load($post);
            $token = $login_form->login();

            if ($token) {
                return $this->response(200, $token);
            }

            if ($login_form->validation_errors) {
                return $this->response(422, $login_form->validation_errors, 'Validation Error!');
            }

            return $this->response(404, null, 'Wrong login or password');
        } catch (\Exception $e) {
            return $this->response(500, null, 'Server Error!');
        }
    }

}