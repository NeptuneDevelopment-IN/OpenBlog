<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogs Related To {{ category_name }}</title>
</head>
<body class="bg-[]">
    <?php
    include(__DIR__.'/../components/navbar.php')

    ?>
    <div class="p-6 md:p-12 bg-green-500 shadow-lg">
        <h1 class="text-5xl font-bold text-gray-800">{{ category_name }}</h1>
        <p class="text-md font-semibold py-1">{{ category_description }}</p>
    </div>
    <div class="p-6 md:p-12 grid gap-3 md:grid-cols-3 grid-cols-1">

        <?php
        require_once (__DIR__.'/../../../OpenBlog/Blog.php');
        $blog = new Blog();
        $cat_id = explode('/', $_SERVER['REQUEST_URI']);
        $blog_id = $cat_id[2];
        $blog_data = $blog->getBlogByCategory($blog_id);
        $blog_data = $blog_data['blogs'];
        if(!empty($blog_data)) {
            $count = count($blog_data);
            for($i=0; $i<$count; $i++) {
                $title = $blog_data[$i]['title'];
                $sec_title = $blog_data[$i]['secondary_title'];
                $blog_id = $blog_data[$i]['blog_id'];
                echo("
            <div class='rounded-lg bg-gray-300 md:hover:scale-110 hover:top-0 transition duration-200 p-3 shadow-md cursor-pointer'>
                <a href='/blog/{$blog_id}'>
                    <h1 class='font-bold text-xl text-gray-700'>{$title}</h1>
                    <p>{$sec_title}</p>
                </a>
            </div>
            
            ");
            }
        } else {
            echo('No Blogs Found in this category');
        }

        ?>

    </div>
    <style>
        body {
            background-color: #E1E2E5;
        }
    </style>
<?php include(__DIR__.'/../components/footer.php') ?>
</body>
</html>