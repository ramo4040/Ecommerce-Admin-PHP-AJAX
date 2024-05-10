<?php

namespace App\Service;

use app\Helper\Validator;
use App\Model\CategoryModel;

define('BASE_URL', 'http://localhost/ecommerce/');

class CategoryService {

    public function __construct(
        private CategoryModel $model,
        private Validator $validator
    ) {
    }

    public function get_all() {
        header('Content-Type: application/json;');
        $data = $this->model->getAll();
        echo json_encode($data);
    }

    public function get_by_id(int $id) {
        header('Content-Type: application/json;');
        $data = $this->model->get($id);
        if (!$data) {
            http_response_code(404);
            echo json_encode(['errMsg' => 'Category not found.']);
            exit;
        }
        echo json_encode($data);
    }

    public function create(string $data) {
        $name = json_decode($data, true);
        print_r($name);
        $this->validator->create($name, ["Category_name" => "required|alpha_num"]);
        if ($this->validator->fails()) {
            http_response_code(422);
            $errors = $this->validator->errors();
            echo json_encode($errors);
        } else {
            $this->model->create($name['Category_name']);
        }
    }

    public function delete($name) {
        $data = trim(json_decode($name));
        $this->model->delete($data);
    }
}
