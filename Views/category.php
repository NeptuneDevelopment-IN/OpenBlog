<?php
include(__DIR__ . '/../OpenBlog/Loader.php');

require_once(__DIR__ . '/../OpenBlog/ThemeManager.php');
require_once(__DIR__ . '/../OpenBlog/ConfigManager.php');
include_once (__DIR__ . '/../OpenBlog/Blog.php');

$theme = new ThemeManager();
$config = new ConfigManager();
$blog = new Blog();
$themeList = $theme->getThemes();
$currentTheme = $config->getConfig()['selected_theme'];

$blogs = $blog->getBlogByCategory($id);

if($currentTheme == null) {
    exit('No Theme Selected');
}

if(in_array($currentTheme, $themeList)) {
    ob_start(); // start output buffering
    include(__DIR__ . "/../Themes/{$currentTheme}/pages/category.php");
    $contents = ob_get_clean(); // get the buffered output and clear the buffer
    $contents = str_replace('{{ category_name }}', $blogs['category']['name'], $contents);
    $contents = str_replace('{{ category_description }}', $blogs['category']['description'], $contents);

}

?>
<?php



echo $contents



?>