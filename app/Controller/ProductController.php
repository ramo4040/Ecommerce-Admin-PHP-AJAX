<?php

namespace App\Controller;

use App\Service\ProductService;
use App\View\ProductsList;


class ProductController {

    private $imagePaths = [];

    public function __construct(private ProductService $service) {
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_FILES['images'])) {
                foreach ($_FILES['images']['name'] as $i => $filename) {
                    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
                    $this->imagePaths[] = ($i) . '.' . $fileExtension;
                }
            }

            $data = array_merge($_POST, ['images' => json_encode($this->imagePaths)]);

            $jsonData = json_encode($data);

            $result = $this->service->create($jsonData);

            if ($result && isset($_FILES['images'])) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/product_images/' . $result;
                mkdir(stripslashes($targetDir), 0755, true);
                foreach ($_FILES['images']['name'] as $i => $filename) {
                    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
                    $targetFile = $targetDir . '/' . ($i) . '.' . $fileExtension;
                    move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetFile);
                }
            }
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $id = file_get_contents('php://input');
            $this->service->delete($id);
        }
    }
}
