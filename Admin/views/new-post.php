<?php
require_once (__DIR__.'/../utils/loader.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../../OpenBlog/ThirdPartyLibs/jQuery/jquery-3.6.4.min.js"></script>
    <script src="../../OpenBlog/ThirdPartyLibs/Summernote/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="../../OpenBlog/ThirdPartyLibs/Summernote/summernote-lite.css">

    <title>Add a new post</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
    <?php

    require_once (__DIR__. '/../../OpenBlog/Loader.php');
    include(__DIR__ . '/../components/sidebar.php');
    require_once (__DIR__. '/../../OpenBlog/ConfigManager.php');
    $cm = new ConfigManager();
    $currentTheme = $cm->getConfig()['selected_theme'];
    $themeInfo = include(__DIR__ . "/../../Themes/{$currentTheme}/theme.php");
    $baseColor = $themeInfo['base_color'];
    $backgroundColor = $themeInfo['background_color'];

    ?>

    <div class="flex-col flex-1 p-6">
        <div class="py-4">
            <h1 class="text-white font-bold text-2xl bg-[#338AFF] p-3 rounded-md">Add a new blog!</h1>
        </div>
        <form action="/ob-administrator/blog-processor" method="POST">
            <div class="grid grid-cols-2 gap-4 pb-6">
                <div class="flex flex-col">
                    <label for="blog_title" class="text-white pb-2">Blog Title</label>
                    <input required type="text" name="blog_title" id="blog_title" class="h-[35px] p-3 bg-gray-300 outline-blue-500/50 rounded-md">
                </div>
                <div class="flex flex-col">
                    <label for="blog_secondary_title" class="text-white pb-2">Secondary Title</label>
                    <input required type="text" name="blog_secondary_title" id="blog_secondary_title" class="h-[35px] bg-gray-300 p-3 outline-blue-500/50	 rounded-md">
                </div>
                <div class="flex flex-col col-span-2">
                    <label for="blog_secondary_title" class="text-white pb-2">Cover Image URL</label>
                    <input required type="url" name="blog_cover_image" id="blog_cover_image" class="h-[35px] bg-gray-300 p-3 outline-blue-500/50	 rounded-md">
                </div>
            </div>
            <div class="flex flex-col">
                <label for="blog_secondary_title" class="text-white pb-2">Blog Description <b>(SEO)</b></label>
                <textarea required type="text" name="blog_description" id="blog_description" class="h-[150px] resize-none bg-gray-300 p-3 outline-blue-500/50 rounded-md"></textarea>
            </div>


            <div class="py-3">
                <label for="editor" class="text-white pb-2">Your Blog Content</label>
                <textarea name="content" id="editor" cols="30" rows="10"></textarea>
            </div>

            

            <div class="flex flex-col py-3">
                <label for="blog_secondary_title" class="text-white pb-2">Tags (Use Commas to Separate)</label>
                <input required type="text" name="tags" id="blog_secondary_title" class="h-[35px] bg-gray-300 p-3 outline-blue-500/50 rounded-md" placeholder="Tags">
            </div>

            <select name="category" id="">
                <?php require_once(__DIR__.'/../../OpenBlog/Blog.php');
                    $blog = new Blog();
                    $categories = $blog->getNumCategories(1000);
                    $count = 0;
                    if(!empty($categories)) {
                        $count = count($categories);
                    }

                    for($i = 0; $i < $count; $i++) {
                        $name = $categories[$i]['name'];
                        $id = $categories[$i]['category_id'];
                        echo("<option value='{$id}'>{$name}</option>");
                    }
                ?>
            </select>
            <div class="p-3 block align-center text-center">
                <input type="submit" class="bg-yellow-300 hover:bg-yellow-200 p-3 rounded-full cursor-pointer w-[150px]" value="Submit">
            </div>
        </form>

        <script>
            $(document).ready(function() {
                $('#editor').summernote({
                    height: 300,
                });
            });

        </script>
        <style>
            .note-editable {
                background-color: white;
            }

            h1 {
                font-size: 2.5rem;
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


    </div>
</body>
</html>