<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add a new user</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex-wrap flex bg-[#1C2033]">
<?php include(__DIR__.'/../components/sidebar.php') ?>
    <div class="flex-col flex-1 p-6">
        <h1 class="bg-blue-500 p-3 text-2xl text-white font-bold rounded-md">Add a user to database</h1>
        <form action="/ob-administrator/users/new" method="post">
            <div class="grid grid-cols-2 gap-3">
                <div class="py-1">
                    <label for="nickname" class="block mb-2 text-sm font-medium text-white">Nickname</label>
                    <input type="text" name="nickname" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="py-1">
                    <label for="nickname" class="block mb-2 text-sm font-medium text-white">Email Address</label>
                    <input type="text" name="email_address" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="py-1">
                    <label for="nickname" class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input type="password" name="password" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="py-1">
                    <label for="nickname" class="block mb-2 text-sm font-medium text-white">Confirm Password</label>
                    <input type="password" name="password_confirm" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="py-1 col-span-2">
                    <label for="nickname" class="block mb-2 text-sm font-medium text-white">Bio</label>
                    <textarea type="text" name="bio" id="nickname" class="h-[150px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <select name="is_admin" class="text-center h-[40px] rounded-md text-lg font-bold" id="">
                    <option value="1">Yes</option>
                    <option value="0" selected>No</option>
                </select>
            </div>
            <button type="submit" name="add_user" class="p-2 bg-blue-500 hover:bg-blue-500/80 my-3 rounded-md">
                Add User
            </button>
        </form>
    </div>


    <?php

    if(isset($_POST['add_user'])) {
        $email = $_POST['email_address'];
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];
        $confirm_password = $_POST['password_confirm'];
        $is_admin = $_POST['is_admin'];
        if($password != $confirm_password) {
            echo('The both passwords do not match');
        } else {
            require_once(__DIR__.'/../../OpenBlog/Authenticator.php');
            $auth = new Authenticator();
            $auth->createUser($email, $password, $nickname, $is_admin);
        }

    }
    ?>

</body>
</html>