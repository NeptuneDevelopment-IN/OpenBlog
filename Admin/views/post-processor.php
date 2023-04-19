<link rel="stylesheet" href="../../OpenBlog/ThirdPartyLibs/Quill/quill.snow.css">

<div id="quill-editor" class="ql-editor" style="font-family: Arial; text-align: left;">
<?php
require_once (__DIR__. '/../../OpenBlog/Loader.php');


if(isset($_POST['preview'])) {
    if(isset($_POST['blog_title'])) {
        echo($_POST['content']);
    }
} else {
    require_once (__DIR__ . '/../../OpenBlog/Blog.php');
    $blog = new Blog();
    $title = $_POST['blog_title'];
    $secondary_title = $_POST['blog_secondary_title'];
    $content = $_POST['content'];
    $author = $_SESSION['user_id'];
    $tags = $_POST['tags'];
    $blog->addBlog($title, $secondary_title, $content, $author, $tags);

}
?>
</div>
