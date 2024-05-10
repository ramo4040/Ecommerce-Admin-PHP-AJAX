<?php

namespace App\Model;

use App\Config\DataBase;

class ProductModel {
    public function __construct(private DataBase $db) {
        $this->db::connect();
    }

    public function getAll($query = null) {
        $sql = "";
        $params = [];

        if ($query) {
            $sql = "WHERE category_id = :id";
            $params = [":id" => $query['category_id']];
        }

        $this->db->query("SELECT * FROM products $sql", $params, true);
        return $this->db->fetchAll(\PDO::FETCH_ASSOC);
    }



    public function create($data) {
        $this->db->query(
            "INSERT INTO products(nameProduct , descProduct , priceProduct , category_id,images) 
                         VALUES(:Pname,:Pdesc,:Pprice,:Pcategory,:images)",
            [
                ':Pname' => $data['Product_name'],
                ':Pdesc' => $data['Description'],
                ':Pprice' => $data['Base_Price'],
                ':Pcategory' => $data['Product_Category'],
                ':images' => $data['images']
            ],
            true
        );

        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM products WHERE idProduct = :id", [':id' => $id], true);
    }
}
