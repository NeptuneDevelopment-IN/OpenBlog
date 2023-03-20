<?php

require_once (__DIR__ . '/../../../OpenBlog/ConfigManager.php');
$config = new ConfigManager();
if(isset($_POST['website_name'])) {
    $config_data = $config->getConfig();
    $config->configWrite('website_name', $_POST['website_name']);
    $config->configWrite('website_description', $_POST['website_description']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Enter your database details</title>
</head>
<body class="bg-gray-700">
<img src="../../../Assets/Logo_1.PNG" class="mx-auto h-[150px]" alt="">
<h1 class="text-2xl text-white font-bold text-center">Please Enter your database details.</h1>
<form action="/install/3" method="post" class="px-12 grid grid-cols-2 gap-4">
    <div class="py-1">
        <label for="database_name" class="text-white font-bold">Database Name*</label>
        <input required placeholder="Your database name" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="database_name" id="database_name" type="text">
    </div>
    <div class="py-1">
        <label for="database_host" class="text-white font-bold">Database Host*</label>
        <input required placeholder="Your database host" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="database_host" id="database_host" type="text">
    </div>
    <div class="py-1">
        <label for="database_user" class="text-white font-bold">Database Username*</label>
        <input required placeholder="Your database username" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="database_user" id="database_user" type="text">
    </div>
    <div class="py-1">
        <label for="database_pass" class="text-white font-bold">Database Password*</label>
        <input placeholder="Password" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="database_pass" id="database_pass" type="password">
    </div>
    <div class="py-1">
        <label for="database_pass" class="text-white font-bold">Database Port*</label>
        <input placeholder="Default: 3306" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="database_port" id="database_port" type="number">
    </div>
    <div class="py-1">
        <input placeholder="Default: 3306" class="block flex align-center button mx-auto bg-green-400 px-6 rounded-full hover:bg-green-500 cursor-pointer py-2" id="database_pass" type="submit">
    </div>
</form>

<?php


?>

</body>
</html>
