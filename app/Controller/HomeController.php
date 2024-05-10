<?php

namespace App\Controller;

use App\Service\CategoryService;
use App\View\MainView;
use App\View\ProductsList;

class HomeController {

    public function __construct(
        private CategoryService $service,
    ) {
    }
    public function index() {
        // GET request method (All Categories)
        $ch = curl_init("http://localhost/ecommerce/api/admin/categories");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $categories = json_decode($response, true);
        //--------------------
        // GET request method (All products)
        $ch = curl_init("http://localhost/ecommerce/api/admin/products");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $products = json_decode($response, true);
        //--------------------

        $data = [];
        $data['products'] = ProductsList::main($products);
        $data['categories'] = $categories;
        MainView::render($data);
    }
}
