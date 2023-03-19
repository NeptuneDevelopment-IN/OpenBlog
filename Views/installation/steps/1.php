
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Basic Website Information | Step 1</title>
</head>
<body class="bg-gray-700">
    <img src="../../../Assets/Logo_1.PNG" class="mx-auto h-[150px]" alt="">
    <h1 class="text-center font-bold text-2xl text-gray-300">Basic Website Information</h1>
    <form class="mx-auto px-[200px] py-3" method="post">
        <div class="py-1">
            <label for="website_name" class="text-white font-bold">Website Name *</label>
            <input placeholder="OpenBlog" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" id="website_name" type="text">
        </div>
        <div class="py-1">
            <label for="website_name" class="text-white font-bold">Website Description *</label>
            <textarea required placeholder="Your Website Description" class="w-full h-[200px] resize-none bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" id="website_name" type="text"></textarea>
        </div>
        <a href="/install/2">
            <input type="submit" value="Next" class="block mx-auto bg-green-400	px-6 rounded-full hover:bg-green-500 cursor-pointer py-2">
        </a>
    </form>
</body>
</html>