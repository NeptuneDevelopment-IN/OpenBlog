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
    $contents = file_get_contents(__DIR__. "/../Themes/{$currentTheme}/pages/blog.php");
    $contents = str_replace('{{ blog_title }}', 'AAAAAAAAA', $contents);
    echo($contents);
}

