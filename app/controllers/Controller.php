<?php

namespace App\controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Controller {

    private $key = '923480239s42@#$@#';

    protected function isLoggedIn () {
        $headers = apache_request_headers();

        $token = $headers['Authentication']??null;

        if (!$token) {
            return false;
        }

        $token = str_ireplace('Bearer ', '', $token);

        if (!$token) {
            return false;
        }

        $decoded_token = JWT::decode($token , new Key($this->key, 'HS256'));
        if (time() > $decoded_token->exp) {
            return false;
        }

        return true;
    }

    protected function response ($status, $data = null, $error = null) {
        $response = [
            'status' => $status,
            'data' => $data,
            'error' => $error
        ];
        return json_encode($response);
    }

}