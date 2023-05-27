<?php
require_once(__DIR__ . '/../utils/loader.php');

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Open Blog Administration Panel</title>
</head>

<body class="bg-[#1C2033] flex flex-wrap">
    <?php include(__DIR__ . '/../components/sidebar.php') ?>
    <div class="flex-col flex-1 p-6">
        <div class="flex block">
            <h1 class="text-white text-2xl font-bold w-full">Administrator Dashboard</h1>
            <a href="/ob-administrator/new" class="float-right flex-none block">
                <button class="bg-white rounded-full p-2">
                    New Post
                </button>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <div class="pt-6">
                <div class="bg-gray-700 w-full p-3 font-bold text-lg text-gray-300 rounded-t-md">
                    Your Recent Posts
                </div>
                <div class="divide-y divide-slate-400 ">
                    <?php
                    require_once(__DIR__ . '/../../OpenBlog/Blog.php');
                    $posts = new Blog();
                    $blogs = $posts->getNumBlogs(3);

                    if ($blogs) {
                        for ($array = 0; $array < count($blogs); $array++) {
                            $blog_id = $blogs[$array]['blog_id'];
                            $title = $blogs[$array]['title'];
                            $sec_title = $blogs[$array]['secondary_title'];
                            echo ("
<div class='divide-y divide-dashed'><a href='/ob-administrator/edit/{$blog_id}' >
<div class='bg-gray-500 hover:bg-gray-600 cursor-pointer transition duration-200 p-3'>
                    <h1 class='font-bold text-lg text-gray-200 truncate'>{$title}</h1>
                    <p class='truncate text-gray-300'>{$sec_title}</p>
                </div>
</a></div>");
                        }
                    } else {
                        echo ("<h1 class='text-white font-semibold p-2 text-center'>No Blogs Found</h1>");
                    }

                    ?>
                </div>
            </div>
            <div class="pt-6">
                <div class="bg-gray-700 font-bold w-full p-3 text-lg text-gray-300 rounded-t-md">
                    Statistics
                </div>
                <div>
                    <table class="w-full border border-slate-500">
                        <tr>
                            <td class="p-3 text-gray-300 font-bold border border-slate-500">Total Posts</td>
                            <td class="p-3 text-gray-300 text-center border border-slate-500">24</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-gray-300 font-bold border border-slate-500">Registered Users</td>
                            <td class="p-3 text-gray-300 text-center border border-slate-500">24</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-gray-300 font-bold border border-slate-500">Open Blog Version</td>
                            <td class="p-3 text-gray-300 text-center border border-slate-500">1.0-ALPHA</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-gray-300 font-bold border border-slate-500">MySQL Database Connection
                            </td>
                            <td class="p-3 text-gray-300 text-center border border-slate-500">Working!</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <?php include __DIR__ . '/../components/footer.php' ?>

    </div>


</body>

</html>