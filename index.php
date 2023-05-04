
<?php
session_start();
define('REQUEST_FROM_INDEX', true);


require_once 'OpenBlog/Router.php';
require_once 'OpenBlog/ConfigManager.php';
require_once 'OpenBlog/ThemeManager.php';
require_once 'OpenBlog/Authenticator.php';

$config_ = new ConfigManager();
$theme = new ThemeManager();
$router = new Router();

if(isset($config_->getConfig()['selected_theme'])) {
    $currentTheme = $config_->getConfig()['selected_theme'];
}

$router->get('/', function() {
    global $config_;
    $config_ = $config_->getConfig();
    if(!file_exists(__DIR__ . '/config.php')) {
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

$router->get('/profile/{id}', function($id) {
    include 'Views/profile.php';
});

$router->get('/ob-administrator/profile', function() {
    include 'Admin/views/profile.php';
});


$router->post('/ob-administrator/profile', function() {
    include 'Admin/views/profile.php';
});

$router->get('/profile', function() {
    include 'Views/profile-editor.php';
});


$router->post('/profile', function() {
    include 'Views/profile-editor.php';
});

$router->get('/ob-administrator/themes', function() {
    include 'Admin/views/themes.php';
});

$router->get('/ob-administrator/settings', function() {
    include 'Admin/views/settings.php';
});

$router->post('/ob-administrator/settings', function() {
    include 'Admin/views/settings.php';
});

$router->post('/ob-administrator/upload-img', function() {
    include 'Admin/views/image-uploader.php';
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

$router->get('/ob-administrator/analytics', function () {
    include('Admin/views/analytics.php');
});

$router->get('/ob-administrator/posts', function () {
    include('Admin/views/posts.php');
});

$router->get('/ob-administrator/edit/{id}', function ($id) {
    include('Admin/views/edit.php');
});

$router->post('/ob-administrator/edit', function () {
    include('Admin/views/edit-processor.php');
});

$router->get('/ob-administrator/pages', function () {
    include('Admin/views/pages.php');
});

$router->get('/ob-administrator/page/{id}', function ($id) {
    include('Admin/views/edit-page.php');
});

$router->post('/ob-administrator/blog-processor', function () {
    include('Admin/views/post-processor.php');
});

$router->get('/install/4', function() {
    header('Location: /install');
});

$router->get('/internal-error', function() {
    global $currentTheme;
    include("Themes/{$currentTheme}/errors/internal.php");
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


$router->get('/login', function() {
    include('Views/auth/login.php');
});

$router->get('/signup', function() {
    include('Views/auth/signup.php');
});

$router->post('/signup', function() {
    include('Views/auth/signup.php');
});

$router->get('/logout', function() {
    include('Views/auth/logout.php');
});

$router->post('/login', function() {
    include('Views/auth/login.php');
});

$router->run();



?>
