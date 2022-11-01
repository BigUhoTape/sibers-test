<?php

namespace App\models;

class RoleModel extends Model {

    const KEYWORD_ADMIN = 'admin';

    public function __construct() {
        $this->table_name = 'role';
        return parent::__construct();
    }

}