<?php

use App\Controller\HomeController;
use App\Routes\Router;

Router::get('/admin', [HomeController::class, 'index']);
