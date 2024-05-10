<?php

namespace App\Service;

use app\Helper\Validator;
use App\Model\ProductModel;


class ProductService {

    public function __construct(
        private ProductModel $model,
        private Validator $validator
    ) {
    }

    public function get_all($query) {
        header("Content-Type: application/json;");
        $data = $this->model->getAll($query);
        echo json_encode($data);
    }


    // public function get_by_id(int $id) {
    // }


    public function create($data) {
        header('Content-Type: application/json;');

        $data = json_decode($data, true);
        $this->validator->create(
            $data,
            [
                'Product_name'  => 'required|alpha_num',
                'Description'  => 'default',
                'Base_Price' => 'required|price'
            ]
        );
        if ($this->validator->fails()) {
            http_response_code(422);
            $errors = $this->validator->errors();
            echo json_encode($errors);
        } else {
            http_response_code(201);
            return $this->model->create($data);
        }
    }

    public function delete(string $id) {
        $id = json_decode($id);
        $this->model->delete($id);
    }
}
