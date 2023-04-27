<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Website Settings | Admin Panel</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
    <?php
    require_once (__DIR__. '/../../OpenBlog/Loader.php');
    include(__DIR__. '/../components/sidebar.php');
    require_once(__DIR__.'/../../OpenBlog/ConfigManager.php');
    $config = new ConfigManager();
    $website_name = $config->getConfig()['website_name'];
    $website_description = $config->getConfig()['website_description'];

    ?>
    <div class="flex-col flex-1 p-6">
        <h1 class="text-white font-bold text-3xl">Website Settings</h1>
        <div class="py-4">
            <h1 class="text-white font-bold text-2xl bg-[#338AFF] p-3 rounded-md">Alter Website Configuration</h1>
        </div>
        <form action="/ob-administrator/settings" method="post">
            <div class="py-1">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Website name</label>
                <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $website_name ?>" required>
            </div>
            <div class="py-1">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Website Description</label>
                <textarea type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-[250px] w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $website_description ?>" required></textarea>
            </div>
        </form>
    </div>

</body>
</html>
