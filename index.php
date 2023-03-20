<?php
require_once 'OpenBlog/Router.php';
require_once 'OpenBlog/ConfigManager.php';

$config_ = new ConfigManager();
$config_ = $config_->getConfig();
$router = new Router();

if ($config_->is_installed !== true) {
    header("/install/1");
}

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
    header('Location: /install');
});

$router->get('/install', function() {
    include('Views/installation/installer.php');
});


$router->post('/install/1', function() {
    include 'Views/installation/steps/1.php';
});

$router->post('/install/2', function() {
    include 'Views/installation/steps/2.php';
});
$router->run();
