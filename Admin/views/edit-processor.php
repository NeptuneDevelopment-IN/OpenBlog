<script src="https://cdn.tailwindcss.com"></script>
<?php
require_once (__DIR__.'/../utils/loader.php');

if(isset($_POST['update_blog'])) {
    require_once(__DIR__.'/../../OpenBlog/Blog.php');
    $blog = new Blog();
    $blog_id = $_POST['blog_id'];
    $blog_title = $_POST['blog_title'];
    $blog_secondary_title = $_POST['blog_secondary_title'];
    $blog_tags = $_POST['blog_tags'];
    $blog_content = $_POST['blog_content'];
    $blog_category = $_POST['category'];
    $blog_description = $_POST['blog_description'];
    $blog_banner_url = $_POST['banner_url'];
    $update = $blog->updateBlog($blog_id, $blog_title, $blog_secondary_title, $blog_tags, $blog_category, $blog_content, $blog_description, $blog_banner_url);
    if($update) {
        echo ('<h1 class="font-semibold text-center text-2xl">Blog Updated Successfully!</h1>');
        header("refresh:1;url=/ob-administrator/edit/{$blog_id}");
    } else {
        echo ('Error');
    }


}