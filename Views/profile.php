<?php
include(__DIR__ . '/../OpenBlog/Loader.php');

require_once(__DIR__ . '/../OpenBlog/ThemeManager.php');
require_once(__DIR__ . '/../OpenBlog/ConfigManager.php');
require_once(__DIR__ . '/../OpenBlog/Blog.php');
require_once(__DIR__ . '/../OpenBlog/Authenticator.php');

$theme = new ThemeManager();
$config = new ConfigManager();
$auth = new Authenticator();
$blog = new Blog();
$themeList = $theme->getThemes();
$currentTheme = $config->getConfig()['selected_theme'];

$data = $auth->getUser($id);
if($currentTheme == null) {
    exit('No Theme Selected');
}

if(in_array($currentTheme, $themeList)) {
    ob_start(); // start output buffering
    include(__DIR__ . "/../Themes/{$currentTheme}/pages/profile.php");
    $contents = ob_get_clean(); // get the buffered output and clear the buffer
    $contents = str_replace('{{ name }}', $data['nickname'], $contents);
    $contents = str_replace('{{ bio }}', $data['bio'], $contents);
    $contents = str_replace('{{ is_admin }}', $data['is_admin'], $contents);
    $contents = str_replace('{{ join_date }}', date("l d F Y", $data['create_date']), $contents);

}

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <?php echo $contents ?>
</body>
</html>