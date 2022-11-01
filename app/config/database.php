<?php

namespace App\config;

use PDO;
use PDOException;

class Database {

    private $host = 'localhost';
    private $db_name = 'sibers';
    private $username = 'sibers';
    private $password = 'sibers';
    private $port = 5432;

    public $db;

    public function getConnection () {
        $this->db = null;
        $dsn = "pgsql:host=".$this->host.";port=".$this->port.";dbname=".$this->db_name;

        try {
            $this->db = new PDO($dsn, $this->username, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $exception) {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $this->db;
    }

}