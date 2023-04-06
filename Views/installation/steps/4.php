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
<?php

if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    $email_address = $_POST['email_address'];
    $nickname = $_POST['nickname'];
    if($password != $confirm_pass) {
        exit("
            <div class=\"p-6\">
        <div class=\"bg-gray-400 p-6 rounded-md\">
            <h1 class=\"text-center text-gray-800 text-3xl font-bold\">The both passwords do not match</h1>
        </div>
    </div>
    <form action='/install/3' method='post'>
        <input class=\"block flex align-center button mx-auto bg-green-400 px-6 rounded-full hover:bg-green-500 cursor-pointer py-2\" name=\"database_pass\" value='Try Again' id=\"database_pass\" type=\"submit\">
    </form>");
    }
}

?>
<div class="flex items-center justify-center">
    <div class="inline-block animate-pulse w-12 h-12 inline-flex border-4 border-t-amber-500 rounded-full animate-spin"></div>
    <h1 class="text-2xl text-white font-bold px-3">Finishing Installation</h1>
</div>
<?php
require(dirname(__DIR__). '/../../OpenBlog/Authenticator.php');

$auth = new Authenticator();
$user = $auth->createUser($email_address, $password, $nickname);

?>
<style>
    .animate-pulse {
        animation-duration: 0.7s; /* Change spinning speed to loading circle */
    }
</style>
</body>
</html>