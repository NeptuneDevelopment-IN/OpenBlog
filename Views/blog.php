<?php 
require_once(__DIR__ . '/../OpenBlog/Blog.php');
$blog = new Blog();
$blog_data = $blog->getBlog(base64_decode($id));
if($blog_data == false || $id == null) {
    header('HTTP/1.1 404 Not Found');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="a.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include('components/header.php') ?>
    <title><?php ?> | Website Name</title>
</head>

<body class="bg-[#1B1D36]">
    <div class="grid grid-cols-1 md:grid-cols-3">
        
        <div class="col-span-2 blog-scroll">
            <h1 class="font-bold text-white text-3xl px-6 pt-6"><?php echo $blog_data['title'] ?></h1>
            <p class="text-gray-400 px-6"><i class="underline"></i> - 15th March at 12:69pm
            </p>
            <div class="mx-6 py-6 ">
                <div class="px-6 py-6 cards border-2 border-gray-500 rounded-md text-xl">
                    <?php  ?>
                </div>        
            </div>
        </div>
        
        
    </div>



    <style>
        /* For Webkit-based browsers (Chrome, Safari and Opera) */
        .blog-scroll::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        .blog-scroll::-webkit-scrollbar-track {
            background: transparent;

        }

        /* Handle */
        .blog-scroll ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;

        }

        /* Handle on hover */
        .blog-scroll::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        
    </style>

</body>

</html>