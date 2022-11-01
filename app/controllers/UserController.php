<?php

namespace App\controllers;

use App\models\UserModel;
use App\models\UserSearch;

class UserController extends Controller {

    public function getUserById () {
        if (!$this->isLoggedIn()) {
            return $this->response(401, null, 'Unauthorized!');
        }

        $user_id = $_GET['user_id']??null;
        if (!$user_id) {
            return $this->response(400, null, 'Bad Request! user_id param is required!');
        }

        $user_model = new UserModel();
        $user = $user_model->findOne($user_id);

        if (!$user) {
            return $this->response(404, null, 'User not found!');
        }

        return $this->response(200, $user);
    }

    public function getUsers () {
        if (!$this->isLoggedIn()) {
            return $this->response(401, null, 'Unauthorized!');
        }

        $search_model = new UserSearch();

        $result = $search_model->search($_GET);

        return $this->response(200, $result);
    }

    public function deleteUser () {
        if (!$this->isLoggedIn()) {
            return $this->response(401, null, 'Unauthorized!');
        }

        $user_id = $_GET['user_id']??null;
        if (!$user_id) {
            return $this->response(400, null, 'Bad Request! user_id param is required!');
        }

        $user_model = new UserModel();
        $user = $user_model->findOne($user_id);

        if (!$user) {
            return $this->response(404, null, 'User not found!');
        }

        $user_model->deleteById($user_id);

        return $this->response(200);
    }

    public function createUser () {
        if (!$this->isLoggedIn()) {
            return $this->response(401, null, 'Unauthorized!');
        }

        $post = json_decode(file_get_contents("php://input"), true);
        $user_model = new UserModel();
        $user_model->load($post);
        $new_user = $user_model->save();
        if ($new_user) {
            return $this->response(200, $new_user);
        }

        if ($user_model->validation_errors) {
            return $this->response(422, $user_model->validation_errors, 'Validation Error');
        }

        return $this->response(500, null, 'Server Error');
    }

    public function updateUser () {
        if (!$this->isLoggedIn()) {
            return $this->response(401, null, 'Unauthorized!');
        }

        $post = json_decode(file_get_contents("php://input"), true);
        if (!isset($post['id'])) {
            return $this->response(400, null, 'Bad Request! id in body is required!');
        }

        $user_model = new UserModel();
        $user = $user_model->findOne($post['id']);

        if (!$user) {
            return $this->response(404, null, 'User not found!');
        }

        $user_model->load($post);
        $updated_user = $user_model->save();
        if ($updated_user) {
            return $this->response(200, $updated_user);
        }

        if ($user_model->validation_errors) {
            return $this->response(422, $user_model->validation_errors, 'Validation Error');
        }

        return $this->response(500, null, 'Server Error');
    }

}