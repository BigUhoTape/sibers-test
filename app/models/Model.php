<?php

namespace App\models;

use App\config\Database;
use PDO;

class Model {

    protected $db;
    protected $table_name;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findOne ($id) {
        $query = "SELECT * FROM {$this->table_name} WHERE id = {$id}";
        $result = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findAll () {
        $query = "SELECT * FROM {$this->table_name}";
        $result = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteById ($id) {
        $this->db->prepare("DELETE FROM {$this->table_name} WHERE id = {$id}")->execute();
    }

    public function load ($data) {
        foreach ($data as $key => $value) {
            if (!property_exists($this, $key)) {
                continue;
            }

            $this->$key = $value;
        }
    }

}
