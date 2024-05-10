<?php

use App\Controller\CategoryController;
use App\Controller\ProductController;
use App\Routes\Router;
use App\Service\CategoryService;
use App\Service\ProductService;

//Category Api (endPoint)
Router::post('/api/admin/category', [CategoryController::class, 'create']);
Router::get('/api/admin/categories', [CategoryService::class, 'get_all']);
Router::get('/api/admin/category/{id}', [CategoryService::class, 'get_by_id']);
Router::delete('/api/admin/category', [CategoryController::class, 'delete']);


//Product Api (endPoint)
Router::post('/api/admin/product', [ProductController::class, 'create']);
Router::get('/api/admin/products', [ProductService::class, 'get_all']);

Router::delete('/api/admin/product', [ProductController::class, 'delete']);
