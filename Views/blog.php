<?php

require_once(__DIR__ . '/../OpenBlog/ThemeManager.php');
require_once(__DIR__ . '/../OpenBlog/Blog.php');
require_once(__DIR__ . '/../OpenBlog/ConfigManager.php');
$theme = new ThemeManager();
$config = new ConfigManager();
$blog = new Blog();
$themeList = $theme->getThemes();
$currentTheme = $config->getConfig()['selected_theme'];

$blog_info = $blog->getBlog($id);

if($currentTheme == null) {
    exit('No Theme Selected');
}

if(in_array($currentTheme, $themeList)) {
    setcookie('id', $id);
    if(!$blog_info) {
        include(__DIR__ . "/../Themes/{$currentTheme}/errors/404.php");
        exit();
    }
    ob_start();
    // Include the PHP file containing the HTML template
    include(__DIR__. "/../Themes/{$currentTheme}/pages/blog.php");
    // Get the contents of the output buffer and clean (erase) it
    $contents = ob_get_clean();
    $contents = str_replace('{{ blog_id }}', $id, $contents);
    $contents = str_replace('{{ blog_title }}', $blog_info['title'], $contents);
    $contents = str_replace('{{ date_created }}', $blog_info['date_created'], $contents);
    $contents = str_replace('{{ secondary_title }}', $blog_info['secondary_title'], $contents);
    $contents = str_replace('{{ content }}', $blog_info['content'], $contents);

}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $blog_info['title'] ?></title>
</head>
<body>
<?php
include(__DIR__. "/../Themes/{$currentTheme}/components/navbar.php");
echo $contents; ?>



</body>
</html>
