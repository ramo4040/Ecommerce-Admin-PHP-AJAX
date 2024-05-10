<?php

namespace App\Controller;

use App\Service\CategoryService;

class CategoryController {

    public function __construct(
        private CategoryService $service
    ) {
    }

    public function create() {
        if (isset($_POST['addCategory'])) {
            $data = json_encode($_POST);
            $this->service->create($data);
            header("Location: " . BASE_URL . 'admin');
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $name = file_get_contents('php://input');
            $this->service->delete($name);
        }
    }
}
