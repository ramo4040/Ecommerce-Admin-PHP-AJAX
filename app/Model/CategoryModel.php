<?php

namespace App\Model;

use App\Config\DataBase;

class CategoryModel {
    public function __construct(
        private DataBase $db
    ) {
        $this->db::connect();
    }

    public function getAll() {
        $this->db->query("SELECT * FROM categories", [], true);
        return $this->db->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function get($id) {
        $this->db->query("SELECT nameCategory FROM categories WHERE idCategory = :id", [':id' => $id], true);
        return $this->db->fetch(\PDO::FETCH_COLUMN);
    }

    public function create($data) {
        $this->db->query('INSERT INTO categories(nameCategory) VALUES (:name)', [':name' => $data], true);
    }

    public function delete($name) {
        $this->db->query("DELETE FROM categories WHERE nameCategory = :name", [':name' => $name], true);
    }
}
