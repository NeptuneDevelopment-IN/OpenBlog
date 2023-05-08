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
    <title>Edit Post</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
    <?php
    require_once (__DIR__.'/../utils/loader.php');
    include(__DIR__. '/../components/sidebar.php') ?>

    <?php
    require_once(__DIR__.'/../../OpenBlog/Blog.php');
    $blog = new Blog();
    $blog_data = $blog->getBlog($id);
    $blog_title = $blog_data['title'];
    $blog_secondary_title = $blog_data['secondary_title'];
    $blog_content = $blog_data['content'];
    $blog_tags = $blog_data['tags'];
    $blog_category = $blog_data['category'];
    $blog_cover = $blog_data['banner_url'];
    $blog_description = $blog_data['description'];
    ?>

    <div class="flex-col flex-1 p-6">
        <h1 class="text-3xl font-bold text-white">Editing A Blog Post</h1>
        <form action="/ob-administrator/edit" method="post">
            <div class="grid grid-cols-2 gap-3">
                <div class="w-full mx-auto">
                    <label for="email" class="block font-medium text-sm text-gray-400 py-3">Blog Title</label>
                    <input type="text" name="blog_title" value="<?php echo $blog_title ?>" class="block h-[40px] p-2 text-gray-300 w-full rounded-md bg-gray-800 border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="w-full mx-auto">
                    <label for="email" class="block font-medium text-sm text-gray-400 py-3">Blog Secondary Title</label>
                    <input type="text" id="email" name="blog_secondary_title" class="block h-[40px] p-2 text-gray-300 w-full rounded-md bg-gray-800 border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo $blog_secondary_title ?>" required>
                </div>
                <div class="w-full mx-auto col-span-2">
                    <label for="email" class="block font-medium text-sm text-gray-400 py-3">Blog Cover Image URL</label>
                    <input type="url" id="email" name="blog_cover_image" class="block h-[40px] p-2 text-gray-300 w-full rounded-md bg-gray-800 border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo $blog_cover ?>" required>
                </div>
                <div class="w-full mx-auto col-span-2">
                    <label for="email" class="block font-medium text-sm text-gray-400 py-3">Blog Description</label>
                    <textarea id="email" name="blog_cover_image" class="block h-[150px] p-2 text-gray-300 w-full rounded-md bg-gray-800 border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required><?php echo $blog_description ?></textarea>
                </div>
                <div class="py-3 col-span-2">
                    <label for="summernote" class="block font-medium text-sm text-gray-400 py-3">Blog Content</label>
                    <textarea id="summernote" name="blog_content" class="rounded-md"><?php echo $blog_content ?></textarea>
                </div>
                <div class="w-full mx-auto">
                    <label for="email" class="block font-medium text-sm text-gray-400 py-3">Tags</label>
                    <input type="text" id="email" name="blog_tags" value="<?php echo $blog_tags; ?>" class="block h-[40px] p-2 text-gray-300 w-full rounded-md bg-gray-800 border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <input type="hidden" name="blog_id" value="<?php echo $id ?>">
                <div class="w-full mx-auto">
                    <label for="" class="block font-medium text-sm text-gray-400 py-3">Category</label>
                    <select name="category" class="w-full h-[40px] bg-gray-800 text-white rounded-md" id="">
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
                            if($id == $blog_data['category']) {
                                $attr = "value='{$id}' class='p-3' selected";
                            } else {
                                $attr = "value='{$id}' class='p-3'";
                            }
                            echo("<option {$attr}>{$name}</option>");
                        }
                        ?>
                    </select>
                </div>
            </div>
           <div class="pt-4 ">
               <button type="submit" name="update_blog" class="mx-auto p-3 rounded-md block bg-blue-500 hover:bg-blue-500/80 transition-colors duration-200 ease-in-out">
                   Save Changes
               </button>
           </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <style>
        .note-editable {
            background-color: white;
            height: 400px;
        }
    </style>

    <?php


    ?>
</body>
</html>