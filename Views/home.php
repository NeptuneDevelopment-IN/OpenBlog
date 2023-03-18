<?php 
require(__DIR__ . "/../OpenBlog/ThemeManager.php");
$theme = new ThemeManager();
print_r($theme->getThemes());


?>