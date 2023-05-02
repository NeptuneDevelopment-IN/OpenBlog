<?php
include(__DIR__ . '/../../OpenBlog/Loader.php');

require_once(__DIR__ . '/../../OpenBlog/ThemeManager.php');
require_once(__DIR__ . '/../../OpenBlog/ConfigManager.php');
require_once(__DIR__ . '/../../OpenBlog/Authenticator.php');


$theme = new ThemeManager();
$config = new ConfigManager();
$auth = new Authenticator();
$themeList = $theme->getThemes();
$currentTheme = $config->getConfig()['selected_theme'];


if($currentTheme == null) {
    exit('No Theme Selected');
}

if(in_array($currentTheme, $themeList)) {
    ob_start(); // start output buffering
    include(__DIR__ . "/../../Themes/{$currentTheme}/pages/auth/login.php");
    $contents = ob_get_clean(); // get the buffered output and clear the buffer


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
<?php


echo $contents;

if(isset($_POST['email_address']) && isset($_POST['password'])) {
    $email = $_POST['email_address'];
    $password = $_POST['password'];
    $pw_hash = $auth->passwordHash($email);
    if(password_verify($password, $pw_hash)) {
        $auth->loginUser($email);
        echo("<div class='p-12 '><h1 class='text-white rounded-md font-bold text-xl bg-green-500 text-center'>Login Successful</h1></div>");
    } else {
        echo("<div class='p-12 '><h1 class='text-white rounded-md font-bold text-xl bg-red-500 text-center'>Invalid Credentials</h1></div>");
    }
}


?>
</body>

</html>