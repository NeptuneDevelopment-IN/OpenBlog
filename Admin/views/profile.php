<?php
require_once (__DIR__.'/../utils/loader.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator Profile</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
    <?php include(__DIR__ . '/../components/sidebar.php'); ?>
    <div class="flex-col flex-1 p-6">
        <h1 class="text-2xl font-bold text-gray-200">Administrator Profile Settings</h1>
        <form action="/ob-administrator/profile" method="post">
            <h1 class="text-white font-semibold py-3">User ID: <?php echo $_SESSION['user_id'] ?></h1>
            <div class="grid gap-3 grid-cols-2">

                <div class="py-1">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-white">Nickname</label>
                    <input type="text" name="nickname" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $_SESSION['nickname'] ?>" required>
                </div>
                <div class="py-1">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-white">Email Address</label>
                    <input type="text" name="email_address" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $_SESSION['email_address'] ?>" required>
                </div>
                <div class="col-span-2">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-white">Bio</label>
                    <textarea name="bio" id="bio" class="w-full h-[200px] bg-gray-50 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 rounded-lg p-2.5 focus:border-blue-500"><?php echo($_SESSION['bio']); ?></textarea>
                </div>
            </div>
            <div class="py-3">
                <button type="submit" class="block font-semibold mx-left w-[150px] h-[40px] rounded bg-blue-500 hover:bg-blue-500/90" name="change_data">Save</button>
            </div>
        </form>
        <div>
            <?php

            if(isset($_POST['change_data'])) {
                $nickname = $_POST['nickname'];
                $bio = $_POST['bio'];
                $email = $_POST['email_address'];
                require_once (__DIR__. '/../../OpenBlog/Authenticator.php');
                $auth = new Authenticator();
                $update = $auth->updateUser($email, $nickname, $bio);
                if($update) {
                    echo('<h1 class="text-white bg-green-600 p-3 rounded-md font-semibold">Updated Successfully!</h1>');
                } else {
                    echo('<h1 class="text-white bg-red-600 p-3 rounded-md font-semibold">Operation Failed!</h1>');
                }
                $_SESSION['bio'] = $bio;
                $_SESSION['nickname'] = $nickname;
                $_SESSION['email_address'] = $email;
            }


            ?>
        </div>
        <?php include __DIR__.'/../components/footer.php' ?>

    </div>


</body>
</html>
