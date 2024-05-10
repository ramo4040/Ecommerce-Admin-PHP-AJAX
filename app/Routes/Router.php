<?php

namespace App\Routes;

use App\Service\App;

class Router {
    private static array $routes = [];

    public static function get(string $route, array $handler): void {
        self::$routes['GET'][$route] = $handler;
    }

    public static function post(string $route, array $handler): void {
        self::$routes['POST'][$route] = $handler;
    }

    public static function put(string $route, array $handler): void {
        self::$routes['PUT'][$route] = $handler;
    }

    public static function delete(string $route, array $handler): void {
        self::$routes['DELETE'][$route] = $handler;
    }

    /**
     * @param array $request_method => GET POST ....
     */

    public static function route(string $request_method): void {
        if (isset(self::$routes[$request_method])) {
            $request_uri = str_replace('/ecommerce', '', $_SERVER['REQUEST_URI']);
            foreach (self::$routes[$request_method] as $route_pattern => $handler) {
                if (self::matchRoute($route_pattern, $request_uri)) {
                    self::callHandler($handler, $request_uri);
                    return;
                }
            }
        }
        http_response_code(404);
        echo '404 Not Found';
    }

    public static function matchRoute($route_pattern, $request_uri): bool {
        if ($route_pattern === '/api/admin/products') {
            return preg_match('/^\/api\/admin\/products(\?.*)?$/', $request_uri);
        }

        $regex = str_replace('/', '\/', $route_pattern);
        $regex = str_replace('{id}', '(\d+)', $regex);
        $regex = '/^' . $regex . '$/';
        return preg_match($regex, $request_uri);
    }

    public static function callHandler($handler, $request_uri): void {
        $matches = [];
        preg_match('/\/\d+\//', $request_uri, $matches);
        $id = $matches[0] ?? null;

        $query = [];
        parse_str(parse_url($request_uri, PHP_URL_QUERY), $query);

        $controller = App::container()->get($handler[0]);
        if ($id) {
            call_user_func([$controller, $handler[1]], $id, $query);
        } else {
            call_user_func([$controller, $handler[1]], $query);
        }
    }
}
