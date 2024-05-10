<?php

use App\Config\DataBase;
use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Controller\ProductController;
use app\Helper\Container;
use app\Helper\Validator;
use App\Model\CategoryModel;
use App\Model\ProductModel;
use App\Service\App;
use App\Service\CategoryService;
use App\Service\ProductService;

$container = new Container();

/**
 * Dependency injection Category
 */
$container->set(DataBase::class, fn () => new DataBase()); // db

$container->set(Validator::class, function () {
    return new Validator();
});

$container->set(HomeController::class, function ($container) {
    $service = $container->get(CategoryService::class);
    // $pController = $container->get(ProductController::class);
    return new HomeController($service);
});

$container->set(CategoryController::class, function ($container) {
    $service = $container->get(CategoryService::class);
    return new CategoryController($service);
});

$container->set(CategoryService::class, function ($container) {
    $model = $container->get(CategoryModel::class);
    $validator = $container->get(Validator::class);
    return new CategoryService($model, $validator);
});

$container->set(CategoryModel::class, function ($container) {
    $db = $container->get(DataBase::class);
    return new CategoryModel($db);
});

//-------------------------------------------------------------------------------

/**
 * Dependency injection Product
 */

$container->set(ProductModel::class, function ($container) {
    $db = $container->get(DataBase::class);
    return new ProductModel($db);
});

$container->set(ProductController::class, function ($container) {
    $service = $container->get(ProductService::class);
    return new ProductController($service);
});

$container->set(ProductService::class, function ($container) {
    $model = $container->get(ProductModel::class);
    $validator = $container->get(Validator::class);
    return new ProductService($model, $validator);
});


App::setContainer($container);
