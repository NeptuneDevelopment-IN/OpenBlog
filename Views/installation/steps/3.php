
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Configure Administrator Account Details</title>

</head>
<body class="bg-gray-700">
<?php
require_once (__DIR__. '/../../../OpenBlog/ConfigManager.php');
$config = new ConfigManager();

//Get the POST data from the previous file and assign variables
if(isset($_POST['database_name'])) {
    $db_user = $_POST['database_user'];
    $db_pass = $_POST['database_pass'];
    $db_name = $_POST['database_name'];
    $db_host = $_POST['database_host'];
    $db_port = $_POST['database_port'];

    if($db_pass == null) {
        $db_pass = "";
    }
    if($db_port == null) {
        $db_port = 3306;
    }
    ini_set('display_errors', 0);
    $conn = new mysqli($db_host,$db_user, $db_pass, $db_name, $db_port);

    //Check by connecting if the database credentials are valid
    if($conn->connect_errno) {
        echo("    <div class=\"p-6\">
        <div class=\"bg-gray-400 p-6 rounded-md\">
            <h1 class=\"text-center text-gray-800 text-3xl font-bold\">An Error Occured while connecting to database</h1>
            <p class=\"text-center text-gray-800 text-2xl font-bold\">Error Message From Server: <br> $conn->connect_error</p>
        </div>
    </div>
    <form action='/install/2' method='post'>
        <input class=\"block flex align-center button mx-auto bg-green-400 px-6 rounded-full hover:bg-green-500 cursor-pointer py-2\" name=\"database_pass\" value='Try Again' id=\"database_pass\" type=\"submit\">
    </form>
    ");
        $conn->close();
    exit();
    }

    //Put the database credentials in the configuration file
    $config->configWrite('database_name', $db_name);
    $config->configWrite('database_user', $db_user);
    $config->configWrite('database_pass', $db_pass);
    $config->configWrite('database_port', $db_port);
    $config->configWrite('database_host', $db_host);
    require(dirname(__DIR__). '/../../OpenBlog/Database.php');
    $db = new Database();
    $db->tableInit('blog_data', 'user_data');
    //if(!$create_db) {
    //    exit('Table already exists please delete the existing tables and try again');
    //}
}
?>
<img src="../../../Assets/Logo_1.PNG" class="mx-auto h-[150px]" alt="">
<h1 class="text-2xl text-white font-bold text-center">Set Administrator Panel Details</h1>
<form action="/install/4" method="post">
    <div class="px-12 grid grid-cols-2 gap-4">
    <div class="py-1">
        <label for="user_name" class="text-white font-bold">Username</label>
        <input required placeholder="Your admin panel username" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="username" id="database_name" type="text">
    </div>
    <div class="py-1">
        <label for="user_name" class="text-white font-bold">Email Address</label>
        <input required placeholder="Your admin panel email" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="email_address" id="database_name" type="email">
    </div>
    <div class="py-1">
        <label for="user_name" class="text-white font-bold">Nickname</label>
        <input required placeholder="Nickname" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="nickname" id="database_name" type="text">
    </div>
    <div class="py-1">
        <label for="user_name" class="text-white font-bold">Password</label>
        <input required placeholder="Password" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="password" id="database_name" type="password">
    </div>
    <div class="py-1">
        <label for="user_name" class="text-white font-bold">Confirm Password</label>
        <input required placeholder="Confirm Password" class="w-full h-[35px] bg-gray-800 p-3 rounded-md text-gray-400 focus:border-2 focus:border-blue-100" name="confirm_password" id="database_name" type="password">
    </div>
    </div>
    <div class="py-3">
        <input placeholder="Default: 3306" class="block flex align-center button mx-auto bg-green-400 px-6 rounded-full hover:bg-green-500 cursor-pointer py-2" id="database_pass" type="submit">
    </div>
</form>


</body>
</html>
