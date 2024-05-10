<?php

define('DS', DIRECTORY_SEPARATOR);

class AutoLoader {
    public static function loader($className) {
        $file = $className . '.php';
        $file = str_replace('\\', '/', $file);
        if (file_exists($file)) require_once $file;
    }
}

spl_autoload_register('AutoLoader::loader');
