<?php
require_once 'OpenBlog/Router.php';
require_once 'OpenBlog/ConfigManager.php';
require_once 'OpenBlog/ThemeManager.php';

$config_ = new ConfigManager();
$config_ = $config_->getConfig();
$theme = new ThemeManager();
if($config_['current_theme'] == null || !isset($config_['current_theme'])) {
    exit('No theme selected for the website please select a theme through the admin dashboard.');
}
$current_theme = $config_['current_theme'];
$theme->setTheme($current_theme);
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
    header('Location: /install');
});

$router->get('/install/2', function() {
    header('Location: /install');
});

$router->get('/install/3', function() {
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

$router->post('/install/3', function() {
    include 'Views/installation/steps/3.php';
});


$router->run();
