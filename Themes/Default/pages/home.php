<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Open Blog!</title>
</head>
<body class="bg-[#E1E2E5]">
    <?php
    require_once (__DIR__.'/../../../OpenBlog/Blog.php');
    require_once (__DIR__.'/../../../OpenBlog/ConfigManager.php');

    include (__DIR__ . '/../components/navbar.php');
    ?>
    <div class="container mx-auto px-6">
        <?php
        if(isset($_GET['search'])) {
            $query = '%'.$_GET['search'].'%';
            require_once (__DIR__.'/../../../OpenBlog/Database.php');
            $sql = "SELECT * FROM blog_data WHERE title LIKE ?";
            $db = new Database();
            $stmt = $db->conn->prepare($sql);
            $stmt->bind_param('s', $query);
            $stmt->execute();
            $blog_data = mysqli_fetch_all($stmt->get_result());

        ?>
        <h1 class="text-3xl md:text-5xl font-bold font-inter text-gray-800 py-6">Your Search Results</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
            <div class="col-span-2">
                <?php
                if ($blog_data) {

                    for ($i=0; $i<count($blog_data); $i++) {
                        $blog_id = $blog_data[$i][1];
                        $title = $blog_data[$i][2];
                        $sec_title = $blog_data[$i][3];
                        $date = $blog_data[$i][6];

                        ?>
                        <a href="/blog/<?= $blog_id ?>">
                            <div class="bg-white hover:bg-gray-100 shadow-lg rounded-lg p-6">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800 leading-tight"><?= $title ?></h2>
                                <p class="text-base md:text-lg text-gray-600 mb-4"><?= $sec_title ?></p>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"><?= date("l d F Y", $date) ?></span>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo("No Blogs Found");
                }
                ?>
            </div>
        </div>

        <?php }?>
        <h1 class="text-3xl md:text-5xl font-bold font-inter text-gray-800 py-6">Latest Blogs</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
            <div class="col-span-2">
                <?php
                $config = new ConfigManager();
                $website_name = $config->getConfig()['website_name'];
                $website_description = $config->getConfig()['website_description'];

                $blog = new Blog();
                $blog_data = $blog->getNumBlogs(3);
                if ($blog_data) {
                    foreach ($blog_data as $item) {
                        $blog_id = $item['blog_id'];
                        $title = $item['title'];
                        $sec_title = $item['secondary_title'];
                        $date = $item['date_created']

                        ?>
                        <a href="/blog/<?= $blog_id ?>">
                            <div class="bg-white hover:bg-gray-100 shadow-lg rounded-lg p-6">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800 leading-tight"><?= $title ?></h2>
                                <p class="text-base md:text-lg text-gray-600 mb-4"><?= $sec_title ?></p>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700"><?= date("l d F Y", $date) ?></span>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo("No Blogs Found");
                }
                ?>
            </div>
            <div>
                <div class="bg-white rounded-lg shadow-md">
                    <form action="/" method="get" class="p-3">
                        <input type="search" name="search" class="block w-full bg-gray-200 text-gray-700  rounded-md px-4 py-2" placeholder="Search Blogs">
                    </form>
                </div>
                <div class="pb-3 shadow-lg">
                    <h2 class="text-2xl font-inter text-gray-800 bg-green-400 py-2 px-4 rounded-lg">About Us</h2>
                    <p class="p-3 bg-white shadow rounded-lg text-gray-700 leading-relaxed"><?= $website_description ?></p>
                </div>
                <div class="bg-white rounded-lg shadow-lg">
                    <h2 class="text-2xl font-inter text-gray-800 py-2 px-4 rounded-lg">Sign Up for our newsletter</h2>
                    <div class="p-3">
                        <form action="/newsletter-signup" method="post">
                            <input type="email" class="block w-full bg-gray-200 text-gray-700 rounded-md px-4 py-2 mb-4" placeholder="Your Email">
                            <button type="submit" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 rounded-full">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div
        </div>
    </div>
    </div>
    <div class="container mx-auto px-6 py-10">
        <h2 class="text-3xl font-bold mb-4">Top Categories</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <a href="#" class="block relative h-48 rounded overflow-hidden">
                    <img alt="category image" class="object-cover object-center w-full h-full block" src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80">
                </a>
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2">Gaming</h3>
                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <a href="#" class="block relative h-48 rounded overflow-hidden">
                    <img alt="category image" class="object-cover object-center w-full h-full block" src="https://th.bing.com/th/id/OIP.5tMUlY_rhhM2EULUO4IS1wHaHa?pid=ImgDet&rs=1">
                </a>
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2">Anime</h3>
                    <p class="text-gray-700 text-base">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <a href="#" class="block relative h-48 rounded overflow-hidden">
                    <img alt="category image" class="object-cover object-center w-full h-full block" src="https://th.bing.com/th/id/OIP.lV8M5Hepc1AYlF362If9kwHaFj?pid=ImgDet&rs=1">
                </a>
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2">Travelling</h3>
                    <p class="text-gray-700 text-base">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <a href="#" class="block relative h-48 rounded overflow-hidden">
                    <img alt="category image" class="object-cover object-center w-full h-full block" src="https://yt3.ggpht.com/-FJXWJ1x1bEQ/AAAAAAAAAAI/AAAAAAAAAAA/ZtyuZ-elFr4/s900-c-k-no-mo-rj-c0xffffff/photo.jpg">
                </a>
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2">Random</h3>
                    <p class="text-gray-700 text-base">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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

        body {
            background-color: #E1E2E5;
        }
    </style>
    <?php include(__DIR__ . '/../components/footer.php') ?>
</body>
</html>