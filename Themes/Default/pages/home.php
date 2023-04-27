<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Open Blog!</title>
</head>
<body class="bg-[#B3B7BD]">
    <?php
    require_once (__DIR__.'/../../../OpenBlog/Blog.php');
    require_once (__DIR__.'/../../../OpenBlog/ConfigManager.php');

    include (__DIR__ . '/../components/navbar.php');
    ?>
    <h1 class="text-3xl p-6 text-gray-800 font-bold font-lexend">Latest Blogs</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 px-6 gap-3">
        <div class="col-span-2">

        <?php
        $config = new ConfigManager();
        $website_name = $config->getConfig()['website_name'];
        $website_description = $config->getConfig()['website_description'];

        $blog = new Blog();
        $blog_data = $blog->getNumBlogs(10);
        if($blog_data) {
            for ($array = 0; $array < count($blog_data); $array++) {
                $blog_id = $blog_data[$array]['blog_id'];
                $title = $blog_data[$array]['title'];
                $sec_title = $blog_data[$array]['secondary_title'];
                echo("<div class='bg-gray-100 hover:bg-gray-200 shadow cursor-pointer rounded-md p-6'><a href='/blog/{$blog_id}' class=''>
            <h1 class='text-xl md:text-2xl font-bold'>{$title}</h1>
            <p class='text-base text-xl font-sora'>{$sec_title}</p>
            </a></div>");
            }
        }else {
            echo("No Blogs Found");
        }

        ?>
        </div>

        <div>
            <div class="pb-3 shadow">
                <h1 class="text-2xl font-lexend text-center text-gray-800 bg-green-400 p-2 rounded-lg">About Us</h1>
                <p class="p-3 bg-gray-100"><?php echo $website_description ?></p>
            </div>
            <div class="bg-gray-100 rounded-lg shadow">
                <h1 class="text-2xl text-center text-gray-800 font-lexend p-2">Sign Up for our newsletter</h1>
                <div class="p-3">
                    <form action="/newsletter-signup" method="post">
                        <input type="email" class="block mx-auto w-[230px] h-[40px] p-2 rounded-md bg-gray-200" placeholder="Your Email">
                        <input type="submit" value="Sign Up" class="block mx-auto bg-green-500 hover:bg-green-400 font-sora p-3 w-[200px] h-[40px] rounded-lg my-3 cursor-pointer">
                    </form>
                </div>
            </div>

        </div>

    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@600&family=Sora:wght@200&display=swap');
        .font-sora {
            font-family: 'Sora';
        }
        .font-lexend {
            font-family: 'Lexend';
        }
    </style>
    <?php include(__DIR__ . '/../components/footer.php') ?>
</body>
</html>