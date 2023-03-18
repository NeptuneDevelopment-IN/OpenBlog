<?php 

/**
 * The Main Routing file for OpenBlog
 * Here are all the stuff related to URI Routing
 */

class Router {
    private $routes = array();
    private $patterns = array();
 
    public function addRoute($route, $handler, $method = 'GET') {
        $this->routes[$method][$route] = $handler;
    }
 
    public function addPattern($pattern, $regex) {
        $this->patterns[$pattern] = $regex;
    }
 
    public function dispatch($method, $uri) {
        $uri = $this->removeQueryString($uri);
 
        foreach ($this->routes[$method] as $route => $handler) {
            $pattern = $this->convertToRegex($route);
 
            if (preg_match("#^{$pattern}$#", $uri, $matches)) {
                array_shift($matches);
                return call_user_func_array($handler, $matches);
            }
        }
 
        throw new Exception('No route found for ' . $method . ' ' . $uri);
    }
 
    private function convertToRegex($route) {
        $pattern = preg_quote($route, '#');
        $pattern = str_replace('/', '\\/', $pattern);
 
        if (!empty($this->patterns)) {
            foreach ($this->patterns as $key => $value) {
                $pattern = str_replace($key, $value, $pattern);
            }
        }
 
        $pattern = preg_replace('#\\\{([^/]+)\\\}#', '(?P<$1>[^/]+)', $pattern);
        return $pattern;
    }
 
    private function removeQueryString($uri) {
        if (strpos($uri, '?') !== false) {
            list($uri, $queryString) = explode('?', $uri, 2);
            $_GET = array_merge($_GET, parse_str($uri, $queryString));
        }
 
        return $uri;
    }
}




?>