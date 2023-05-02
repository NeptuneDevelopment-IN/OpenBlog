<script src="../../OpenBlog/ThirdPartyLibs/jQuery/jquery-3.6.4.min.js"></script>
<script src="../../OpenBlog/ThirdPartyLibs/Summernote/summernote-lite.min.js"></script>
<link rel="stylesheet" href="../../OpenBlog/ThirdPartyLibs/Summernote/summernote-lite.css">

<div id="quill-editor" class="ql-editor" style="font-family: Arial; text-align: left;">
<?php
require_once (__DIR__. '/../../OpenBlog/Loader.php');


require_once (__DIR__ . '/../../OpenBlog/Blog.php');
$blog = new Blog();
$title = $_POST['blog_title'];
$secondary_title = $_POST['blog_secondary_title'];
$content = $_POST['content'];
$author = $_SESSION['user_id'];
$tags = $_POST['tags'];
$category_id = $_POST['category'];
$blog->addBlog($title, $secondary_title, $content, $author, $tags, $category_id);


?>
</div>