<?php
session_start();
define('REQUEST_FROM_INDEX', true);


require_once 'OpenBlog/Router.php';
require_once 'OpenBlog/ConfigManager.php';
require_once 'OpenBlog/ThemeManager.php';

$config_ = new ConfigManager();
$theme = new ThemeManager();
$router = new Router();


$router->get('/', function() {
    global $config_;
    $config_ = $config_->getConfig();
    if(!file_exists(__DIR__ . '/config.json')) {
        exit('Open blog is not installed <a href="/install">Click Here</a> to install it');
    }
    if(!$config_['is_installed']) {
        exit('Open blog is not installed <a href="/install">Click Here</a> to install it');
    }
    if($config_['selected_theme'] == null) {
        exit('No theme selected please select it through the admin panel');
    }
    include 'Views/home.php';
});

$router->get('/blog/{id}', function($id) {
    include 'Views/blog.php';
});

$router->get('/ob-administrator/themes', function() {
    include 'Admin/views/themes.php';
});

$router->get('/ob-administrator/settings', function() {
    include 'Admin/views/settings.php';
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

$router->get('/ob-administrator', function () {
    include('Admin/views/panel.php');
});

$router->get('/ob-administrator/new', function () {
    include('Admin/views/new-post.php');
});

$router->post('/ob-administrator/new/preview', function () {
    include('Admin/views/preview.php');
});

$router->get('/install/4', function() {
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

$router->post('/install/4', function() {
    include 'Views/installation/steps/4.php';
});



$router->run();



?>
