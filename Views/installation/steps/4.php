<?php
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    $email_address = $_POST['email_address'];
    $nickname = $_POST['nickname'];
}

if(!$password == $confirm_pass) {
    exit('The both password do not match');
}

require_once(__DIR__. "/../../../OpenBlog/Database.php");
$db = new Database();

$sql = "CREATE TABLE IF NOT EXISTS user_data";





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Basic Website Information | Step 1</title>
</head>
<body class="bg-gray-700">
<img src="../../../Assets/Logo_1.PNG" class="mx-auto h-[150px]" alt="">
<h1 class="text-center font-bold text-2xl text-gray-300">Choose your website theme</h1>
<h1 class="text-center font-bold text-xl text-gray-300">You can change this in the administrator panel later..</h1>
<form action="/install/2" class="mx-auto px-[200px] py-3" method="post">
    <div class="py-1">
        <label for="website_name" class="text-white font-bold">Website Name *</label>
        <input placeholder="OpenBlog" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="website_name" id="website_name" type="text">
    </div>
    <div class="py-1">
        <label for="website_name" class="text-white font-bold">Website Description *</label>
        <textarea required placeholder="Your Website Description" class="w-full h-[200px] resize-none bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" id="website_name" name="website_description" type="text"></textarea>
    </div>
    <input type="submit" value="Next" class="block button mx-auto bg-green-400 px-6 rounded-full hover:bg-green-500 cursor-pointer py-2">
</form>



</body>
</html>