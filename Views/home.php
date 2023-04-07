<?php
require_once(__DIR__ . '/../OpenBlog/ThemeManager.php');

require_once(__DIR__ . '/../OpenBlog/ConfigManager.php');
$theme = new ThemeManager();
$config = new ConfigManager();
$themeList = $theme->getThemes();
$currentTheme = $config->getConfig()['selected_theme'];


if($currentTheme == null) {
    exit('No Theme Selected');
}

if(in_array($currentTheme, $themeList)) {
    ob_start(); // start output buffering
    include(__DIR__ . "/../Themes/{$currentTheme}/pages/home.php");
    $contents = ob_get_clean(); // get the buffered output and clear the buffer
    $contents = str_replace('{{ blog_title }}', 'AAAAAAAAA', $contents);
    echo $contents;
}

?>

