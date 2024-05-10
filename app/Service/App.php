<?php

namespace App\Service;

class App {
    private static $container;

    public static function setContainer($container) {
        self::$container = $container;
    }

    public static function container() {
        return self::$container;
    }
}
