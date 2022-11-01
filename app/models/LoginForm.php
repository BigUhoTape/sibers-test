<?php

namespace App\models;

use Firebase\JWT\JWT;

class LoginForm extends Model {

    private $key = '923480239s42@#$@#';

    public $login = null;
    public $password = null;

    public $validation_errors = [];

    public function __construct() {
        $this->table_name = 'users';
        return parent::__construct();
    }

    private function validate () {
        if (!$this->login) {
            $this->validation_errors['login'] = 'Login is required';
        } elseif (!is_string($this->login)) {
            $this->validation_errors['login'] = 'Login must be a string';
        } elseif (strlen($this->login) > 50) {
            $this->validation_errors['login'] = 'Login must be no more than 50 characters';
        }

        if (!$this->password) {
            $this->validation_errors['password'] = 'Password is required';
        } elseif (!is_string($this->password)) {
            $this->validation_errors['password'] = 'Password must be a string';
        } elseif (strlen($this->password) > 50) {
            $this->validation_errors['password'] = 'Password must be no more than 50 characters';
        }

        if ($this->validation_errors) {
            return false;
        }

        return true;
    }

    private function getUser () {
        if (!$this->validate()) {
            return false;
        }

        $admin_keyword = RoleModel::KEYWORD_ADMIN;
        $query = "
            SELECT *, {$this->table_name}.id as id
            FROM {$this->table_name}
            JOIN role ON role.id = {$this->table_name}.role_id
            WHERE login = '{$this->login}' AND password = '{$this->password}' AND keyword = '{$admin_keyword}'
        ";

        $user = $this->db->query($query)->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    public function login () {
        if (!$this->getUser()) {
            return false;
        }

        $issueDate = time();
        $expirationDate = time() * 3600;
        $payload = array(
            "iss" => "http://sibers.local",
            "aud" => "http://sibers.local",
            "iat" => $issueDate,
            "exp" => $expirationDate,
            "user_id" => $this->getUser()['id'],
        );

        $token = JWT::encode($payload, $this->key, 'HS256');

        return $token;
    }
}