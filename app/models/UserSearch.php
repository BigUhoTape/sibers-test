<?php

namespace App\models;

class UserSearch extends UserModel {

    public $page_size = 5;
    public $page = 1;
    public $sort = 'id';
    public $sort_dir = 'ASC';

    public function load ($data) {
        parent::load($data);

        $this->page_size = (int) $this->page_size;
        $this->page = (int) $this->page;
    }

    public function search ($data) {
        $this->load($data);

        $offset = $this->page_size * ($this->page - 1);

        $query_count = "SELECT count(*) FROM {$this->table_name}";
        $count = $this->db->query($query_count)->fetchColumn();

        $pages_count = intdiv($count, $this->page_size);
        if ( ($count % $this->page_size) > 0) {
            $pages_count += 1;
        }

        $query = "
            SELECT id, login, name, last_name
            FROM {$this->table_name}
            ORDER BY {$this->sort} {$this->sort_dir}
            LIMIT {$this->page_size}
            OFFSET {$offset}
        ";
        $users = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        return [
            'pages_count' => $pages_count,
            'users' => $users
        ];
    }

}