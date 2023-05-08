<?php

class Router
{
    private $routes = array();
    private $basePath = '';

    public function __construct()
    {
        require_once (__DIR__.'/ConfigManager.php');
        $config = new ConfigManager();
        $currentTheme = $config->getConfig('selected_theme');
    }

    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '/');

    }

    public function get($route, $callback)
    {
        $this->routes['GET'][$this->basePath . $route] = $callback;
    }

    public function post($route, $callback)
    {
        $this->routes['POST'][$this->basePath . $route] = $callback;
    }

    public function put($route, $callback)
    {
        $this->routes['PUT'][$this->basePath . $route] = $callback;
    }

    public function delete($route, $callback)
    {
        $this->routes['DELETE'][$this->basePath . $route] = $callback;
    }

   
    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = $_SERVER['REQUEST_URI'];

        if (strpos($requestUrl, ".php") !== false) {
            http_response_code(404);
            global $currentTheme;
            if($currentTheme == null) {
                echo ('404 Not Found');
            } else {
                include(__DIR__."/../Themes/{$currentTheme}/errors/404.php");
            }

            return;
        }

        if (strpos($requestUrl, ".json") !== false) {
            http_response_code(404);
            global $currentTheme;
            if($currentTheme == null) {
                echo ('404 Not Found');
            } else {
                include(__DIR__."/../Themes/{$currentTheme}/errors/404.php");
            }            return;
        }

        // Remove query string from URL
        $pos = strpos($requestUrl, '?');
        if ($pos !== false) {
            $requestUrl = substr($requestUrl, 0, $pos);
        }

        $routes = $this->routes[$requestMethod] ?? array();
    
        foreach ($routes as $route => $callback) {
            $pattern = str_replace('/', '\/', $route);
            $pattern = preg_replace('/{([A-Za-z0-9_]+)}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';
    
            if (preg_match($pattern, $requestUrl, $matches)) {
                $params = array();
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
    
                if ($requestMethod === 'POST') {
                    $params['POST'] = $_POST;
                }
    
                call_user_func_array($callback, array_values($params));
                return;
            }
        }
    
        // Show 404 error if no route is matched
        if ($requestMethod === 'GET') {
            http_response_code(404);
            global $currentTheme;
            if($currentTheme == null) {
                echo ('404 Not Found');
            } else {
                include(__DIR__."/../Themes/{$currentTheme}/errors/404.php");
            }
        }
    }
    
}
