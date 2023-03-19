<?php
require_once 'OpenBlog/Router.php';


$router = new Router();



$router->get('/', function() {
    include 'Views/home.php';
});

$router->get('/blog', function() {
    include 'Views/blog.php';
});

$router->get('/blog/{id}', function($id) {
    include 'views/blog.php';
});

$router->get('/install/1', function() {
    include 'Views/installation/steps/1.php';
});

$router->post('/install/1', function() {
    include 'Views/installation/steps/2.php';
});

//if(!$config->get('is_installed')) {
//    header('Location:/install/1');
//}


$router->post('/install/2', function() {
    include 'Views/installation/steps/2.php';
});
$router->run();
