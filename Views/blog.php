<?php
include(__DIR__ . '/../OpenBlog/Loader.php');

require_once(__DIR__ . '/../OpenBlog/ThemeManager.php');
require_once(__DIR__ . '/../OpenBlog/Blog.php');
require_once(__DIR__ . '/../OpenBlog/ConfigManager.php');
require_once(__DIR__ . '/../OpenBlog/Authenticator.php');

$auth = new Authenticator();
$theme = new ThemeManager();
$config = new ConfigManager();
$blog = new Blog();
$themeList = $theme->getThemes();
$currentTheme = $config->getConfig()['selected_theme'];

$blog_info = $blog->getBlog($id);
$author_details = $auth->getUser($blog_info['author']);

$category_details = $blog->getCategory($blog_info['category']);

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
    if($author_details['is_admin']) {
        $is_admin = 'Yes';
    } else {
        $is_admin = 'No';
    }

    // Get the contents of the output buffer and clean (erase) it
    $contents = ob_get_clean();
    $contents = str_replace('{{ blog_id }}', $id, $contents);
    $contents = str_replace('{{ blog_title }}', $blog_info['title'], $contents);
    $contents = str_replace('{{ date_created }}', date("l d F Y", $blog_info['date_created']), $contents);
    $contents = str_replace('{{ date_created_2 }}', date("Y-m-d\TH:i:s\Z", $blog_info['date_created']), $contents);
    $contents = str_replace('{{ secondary_title }}', $blog_info['secondary_title'], $contents);
    $contents = str_replace('{{ content }}', $blog_info['content'], $contents);
    $contents = str_replace('{{ author_id }}', $blog_info['author'], $contents);
    $contents = str_replace('{{ author_name }}', $author_details['nickname'], $contents);
    $contents = str_replace('{{ author_bio }}', $author_details['bio'], $contents);
    $contents = str_replace('{{ is_admin }}', $is_admin , $contents);
    $contents = str_replace('{{ author_join }}', date("l d F Y", $author_details['create_date']), $contents);
    $contents = str_replace('{{ tags }}', $blog_info['tags'], $contents);
    $contents = str_replace('{{ category_name }}', $category_details[0]['name'], $contents);
    $contents = str_replace('{{ category_description }}', $category_details[0]['description'], $contents);
    $contents = str_replace('{{ cover_image }}', $blog_info['banner_url'], $contents);
    $contents = str_replace('{{ blog_description }}', $blog_info['description'], $contents);
    $contents = str_replace('{{ website_name }}', $config->getConfig('website_name'), $contents);
    $contents = str_replace('{{ website_description }}', $config->getConfig('website_description'), $contents);

}
?>



    <?php
    echo $contents; ?>
<style>
    h1 {
        font-size: 2.5rem;
        color: #374151;
        font-weight: 700;
    }

    h2 {
        font-size: 2rem;
    }

    h3 {
        font-size: 1.5rem;
    }

    h4 {
        font-size: 1.25rem;
    }

    h5 {
        font-size: 1rem;
    }

    h6 {
        font-size: 0.875rem;
    }


</style>


