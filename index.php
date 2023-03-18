<?php
require_once 'OpenBlog/Router.php';
require_once 'ob-config.php';



$router = new Router();

$router->addRoute('/', function() {
    require 'Views/home.php';
});

$router->addRoute('/users', function() {
    require 'views/users.php';
});

$router->addRoute('/blog/{id}', function($id) {
    require 'Views/blog.php';
});

$router->addPattern('{id}', '\d+');

try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    echo $e->getMessage();
}