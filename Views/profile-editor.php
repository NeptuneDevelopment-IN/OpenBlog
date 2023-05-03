<?php
if(!$_SESSION['is_logged_in']) {
    header('Location: /login');
}


include(__DIR__ . '/../OpenBlog/Loader.php');

require_once(__DIR__ . '/../OpenBlog/ThemeManager.php');
require_once(__DIR__ . '/../OpenBlog/ConfigManager.php');
include_once (__DIR__ . '/../OpenBlog/Blog.php');
require_once(__DIR__ . '/../OpenBlog/Authenticator.php');

$theme = new ThemeManager();
$config = new ConfigManager();
$blog = new Blog();
$themeList = $theme->getThemes();
$currentTheme = $config->getConfig()['selected_theme'];
$auth = new Authenticator();


if($currentTheme == null) {
    exit('No Theme Selected');
}

if(in_array($currentTheme, $themeList)) {
    ob_start(); // start output buffering
    include(__DIR__ . "/../Themes/{$currentTheme}/pages/profile-editor.php");
    $contents = ob_get_clean(); // get the buffered output and clear the buffer

}

$data = $auth->getUser($_SESSION['user_id']);
if($currentTheme == null) {
    exit('No Theme Selected');
}

if(in_array($currentTheme, $themeList)) {
    ob_start(); // start output buffering
    include(__DIR__ . "/../Themes/{$currentTheme}/pages/profile-editor.php");
    $contents = ob_get_clean(); // get the buffered output and clear the buffer
    $contents = str_replace('{{ name }}', $data['nickname'], $contents);
    $contents = str_replace('{{ bio }}', $data['bio'], $contents);
    $contents = str_replace('{{ join_date }}', date("l d F Y", $data['create_date']), $contents);

}

?>

<?php

echo $contents;

require_once(__DIR__.'/../OpenBlog/Authenticator.php');
$auth = new Authenticator();

if(isset($_POST['change_information'])) {
    $email_address = $_POST['email_address'];
    $nickname = $_POST['nickname'];
    $bio = $_POST['bio'];
    $auth->updateUser($email_address, $nickname, $bio);
    $_SESSION['email_address'] = $email_address;
    $_SESSION['nickname'] = $nickname;
    $_SESSION['bio'] = $bio;
} else if(isset($_POST['change_password'])) {
    $old_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['new_password_repeat'];
    $email = $_SESSION['email_address'];
    if($new_password != $repeat_new_password) {
        exit('Make sure both of the passwords match in the fields!');
    }
    $pass_change = $auth->changePassword($email, $old_password, $new_password);
    if(!$pass_change) {
        exit('Could not change the password. Make sure the current passwords are correct');
    }
    echo("<div class='px-6'><div class='font-regular px-6 relative mb-4 block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100'>
  Password Changed Successfully
</div></div>");
}


?>
