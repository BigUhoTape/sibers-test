<?php

namespace App\models;

class UserModel extends Model {

    public $id = null;
    public $login = null;
    public $password = null;
    public $name = null;
    public $last_name = null;
    public $gender = null;
    public $birthday = null;
    public $role_id = null;

    private $old_login = null;

    public $validation_errors = [];

    public function __construct() {
        $this->table_name = 'users';
        return parent::__construct();
    }

    public function findOne($id) {
        $user = parent::findOne($id);
        if (!$user) {
            return null;
        }

        foreach ($user as $key => $value) {
            if (!property_exists($this, $key)) {
                continue;
            }

            if ($key == 'login') {
                $this->old_login = $value;
            }

            $this->$key = $value;
        }

        return $user;
    }

    private function validate () {
        if (!$this->login) {
            $this->validation_errors['login'] = 'Login is required';
        } elseif (!is_string($this->login)) {
            $this->validation_errors['login'] = 'Login must be a string';
        } elseif (strlen($this->login) > 50) {
            $this->validation_errors['login'] = 'Login must be no more than 50 characters';
        } elseif (!$this->id || $this->login != $this->old_login) {
            $query = "SELECT login FROM {$this->table_name}";
            $logins = $this->db->query($query)->fetchAll(\PDO::FETCH_COLUMN);
            if (in_array($this->login, $logins)) {
                $this->validation_errors['login'] = 'User with that login already exist';
            }
        }

        if (!$this->password) {
            $this->validation_errors['password'] = 'Password is required';
        } elseif (!is_string($this->password)) {
            $this->validation_errors['password'] = 'Password must be a string';
        } elseif (strlen($this->password) > 50) {
            $this->validation_errors['password'] = 'Password must be no more than 50 characters';
        }

        if (!$this->name) {
            $this->validation_errors['name'] = 'Name is required';
        } elseif (!is_string($this->name)) {
            $this->validation_errors['name'] = 'Name must be a string';
        } elseif (strlen($this->name) > 50) {
            $this->validation_errors['name'] = 'Name must be no more than 50 characters';
        }

        if (!$this->last_name) {
            $this->validation_errors['last_name'] = 'Last Name is required';
        } elseif (!is_string($this->last_name)) {
            $this->validation_errors['last_name'] = 'Last Name must be a string';
        } elseif (strlen($this->last_name) > 50) {
            $this->validation_errors['last_name'] = 'Last Name must be no more than 50 characters';
        }

        if (!$this->gender) {
            $this->validation_errors['gender'] = 'Gender is required';
        } elseif (!is_string($this->gender)) {
            $this->validation_errors['gender'] = 'Gender must be a string';
        } elseif (strlen($this->gender) > 50) {
            $this->validation_errors['gender'] = 'Gender must be no more than 50 characters';
        }

        if (!$this->birthday) {
            $this->validation_errors['birthday'] = 'Birthday is required';
        } else {
            $format = 'Y-m-d';
            $d = \DateTime::createFromFormat($format, $this->birthday);
            if (!$d || $d->format($format) !== $this->birthday) {
                $this->validation_errors['birthday'] = 'Wrong birthday';
            }
        }

        if (!$this->role_id) {
            $this->validation_errors['role_id'] = 'Role is required';
        } else {
            $role_model = new RoleModel();
            $roles = $role_model->findAll();
            $role_ids = [];
            foreach ($roles as $role) {
                $role_ids[] = $role['id'];
            }

            if (!in_array($this->role_id, $role_ids)) {
                $this->validation_errors['role_id'] = 'Role does not exist';
            }
        }

        if ($this->validation_errors) {
            return false;
        }

        return true;
    }

    public function save () {
        if (!$this->validate()) {
            return false;
        }

        if ($this->id) {
            $this->update();
        } else {
            $this->create();
        }

        return [
            'id' => $this->id,
            'login' => $this->login,
            'password' => $this->password,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'role_id' => $this->role_id
        ];
    }

    private function update () {
        $query = "UPDATE {$this->table_name}
                        SET login = '{$this->login}',
                            password = '{$this->password}',
                            name = '{$this->name}',
                            last_name = '{$this->last_name}',
                            gender = '{$this->gender}',
                            birthday = '{$this->birthday}',
                            role_id = '{$this->role_id}'
                        WHERE id = {$this->id};";
        $query = $this->db->prepare($query);
        $query->execute();
    }

    private function create () {
        $query = "INSERT INTO {$this->table_name}
                        (login, password, name, last_name, gender, birthday, role_id) 
                        VALUES ('{$this->login}', '{$this->password}', '{$this->name}', '{$this->last_name}', '{$this->gender}', '{$this->birthday}', {$this->role_id})";
        $query = $this->db->prepare($query);
        $query->execute();

        $this->id = $this->db->lastInsertId();
    }

}