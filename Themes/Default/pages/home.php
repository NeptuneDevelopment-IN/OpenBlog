<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Open Blog!</title>
</head>
<body>
    <?php
    require_once (__DIR__.'/../../../OpenBlog/Blog.php');
    include (__DIR__ . '/../components/navbar.php');
    ?>
    <h1 class="text-3xl p-6 text-gray-700">Latest Blogs</h1>

    <div class="grid grid-cols-3 px-6 gap-3">
        <?php
        $blog = new Blog();
        $blog_data = $blog->getNumBlogs(10);
        if($blog_data) {
            for ($array = 0; $array < count($blog_data); $array++) {
                $blog_id = $blog_data[$array]['blog_id'];
                $title = $blog_data[$array]['title'];
                $sec_title = $blog_data[$array]['secondary_title'];
                echo("<a href='/blog/{$blog_id}' class='bg-gray-300 hover:bg-gray-400 shadow cursor-pointer col-span-2 rounded-md p-3'>
            <h1 class='text-xl font-bold'>{$title}</h1>
            <p class='text-base font-'>{$sec_title}</p>
</a>");
            }
        }else {
            echo("No Blogs Found");
        }

        ?>

    </div>


</body>
</html>