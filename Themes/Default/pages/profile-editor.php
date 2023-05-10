<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>
    <!-- Load Tailwind CSS from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css" integrity="sha512-9y+WSMPcWTMDanJdYjvpPE6qRh3r2+PlOJFyODtxCmD9pwykrRmzKybUJiYUaZ6UqQ48PlPG+zP7OMz6Lj9Dkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">
<?php include(__DIR__.'/../components/navbar.php'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl text-gray-800 font-bold mb-6">Edit your profile</h1>
    <h1 class="text-2xl text-gray-800 font-bold bg-green-500 p-3 rounded-md">Basic Information</h1>
    <p class="my-4"><b>User ID:</b> <?php echo($_SESSION['user_id']) ?></p>
    <form action="/profile" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="nickname" class="block font-medium text-gray-700 mb-2">Nickname</label>
            <input type="text" name="nickname" value="<?php echo $_SESSION['nickname'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500" id="nickname">
        </div>
        <div>
            <label for="email_address" class="block font-medium text-gray-700 mb-2">Email Address</label>
            <input type="text" name="email_address" value="<?php echo $_SESSION['email_address'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500" id="email_address">
        </div>
        <div class="col-span-2">
            <label for="bio" class="block font-medium text-gray-700 mb-2">Bio</label>
            <textarea name="bio" id="bio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500 h-32"><?php echo $_SESSION['bio'] ?></textarea>
        </div>
        <div class="col-span-2">
            <button type="submit" name="change_information" class="py-2 px-4 bg-green-500 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Save Changes</button>
        </div>
    </form>
    <h1 class="text-3xl text-gray-800 font-bold mb-6">Account Settings</h1>
    <h1 class="text-2xl text-gray-800 font-bold bg-green-500 p-3 rounded-md">Change your password</h1>
    <div>
        <form class="grid grid-cols-1 md:grid-cols-2 gap-3 my-4" action="/profile" method="post">
            <div>
                <label for="nickname" class="block font-medium text-gray-700 mb-2">Current Password</label>
                <input type="password" name="current_password" placeholder="Your Current Password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500" id="nickname">
            </div>
            <div>
                <label for="nickname" class="block font-medium text-gray-700 mb-2">New Password</label>
                <input type="password" name="new_password" placeholder="Your Current Password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500" id="nickname">
            </div>
            <div>
                <label for="nickname" class="block font-medium text-gray-700 mb-2">Repeat New Password</label>
                <input type="password" name="new_password_repeat" placeholder="Your Current Password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500" id="nickname">
            </div>
            <div class="col-span-2">
                <button type="submit" name="change_password" class="py-2 px-4 bg-green-500 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<?php include(__DIR__.'/../components/footer.php')?>
</body>
</html>
