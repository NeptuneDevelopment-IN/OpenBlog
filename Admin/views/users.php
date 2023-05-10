<?php
include(__DIR__.'/../utils/loader.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User List</title>
</head>
<body class="flex-wrap flex bg-[#1C2033]">
    <?php include(__DIR__.'/../components/sidebar.php'); ?>
    <div class="flex-col flex-1 p-6">
        <div class="flex block py-3">
            <h1 class="text-white text-2xl font-bold w-full">Administrator Dashboard</h1>
            <a href="/ob-administrator/users/new" class="float-right flex-none block">
                <button class="bg-blue-500 hover:bg-blue-500/80 rounded-md p-2 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                    New User
                </button>
            </a>
        </div>

        <div class="inline-flex bg-blue-500 w-full rounded-md">
            <h1 class="text-2xl font-bold p-3 text-white">User List</h1>

        </div>

        <?php
        require_once(__DIR__.'/../../OpenBlog/Authenticator.php');
        $auth = new Authenticator();
        $users = $auth->getUsers(10);
        ?>

            <table class="table-auto w-full bg-gray-800 rounded-lg overflow-hidden">
                <thead class="text-gray-500">
                <tr>
                    <th class="py-3 px-4 text-left">User ID</th>
                    <th class="py-3 px-4 text-left">Nickname</th>
                    <th class="py-3 px-4 text-left">Email Address</th>
                    <th class="py-3 px-4 text-left">Create Date</th>
                    <th class="py-3 px-4 text-left">Is Admin</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                <?php
                foreach($users as $user) {
                    $user_id = $user['user_id'];
                    $nickname = $user['nickname'];
                    $email_address = $user['email_address'];
                    $create_date = $user['create_date'];
                    $is_admin = "No";
                    if($user['is_admin']) {
                        $is_admin = "Yes";
                    }
                    $date = date("d-m-Y", $user['create_date']);
                    echo ("
                    <tr class='text-gray-400'>
                        <td class='py-3 px-4'>{$user_id}</td>
                        <td class='py-3 px-4'>{$nickname}</td>
                        <td class='py-3 px-4'>{$email_address}</td>
                        <td class='py-3 px-4'>{$date}</td>
                        <td class='py-3 px-4'>{$is_admin}</td>
                    </tr>
                    ");
                }
                ?>
                <!-- Add more rows here -->
                </tbody>
            </table>
        <?php include __DIR__.'/../components/footer.php' ?>


    </div>
</body>
</html>
