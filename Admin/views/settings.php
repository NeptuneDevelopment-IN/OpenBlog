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
    <title>Website Settings | Admin Panel</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
    <?php
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
                <label for="first_name" class="block mb-2 text-sm font-medium text-white">Website name</label>
                <input type="text" name="website_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $website_name ?>" required>
            </div>
            <div class="py-1">
                <label for="first_name" class="block mb-2 text-sm font-medium text-white">Website Description</label>
                <textarea type="text" id="first_name" name="website_description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-[250px] w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $website_description ?>" ></textarea>
            </div>
            <div class="py-1">
                <label for="display_errors" class="mb-2 text-sm font-medium text-white">Debug Mode</label>
                <select name="display_errors" class="w-[150px] h-[30px] rounded-md" id="display_errors">
                    <?php
                    if($config->getConfig()['debug_mode']) {
                        echo('<option value="true" selected>Yes</option>
                    <option value="false">No</option>');
                    } else {
                        echo('<option value="true">Yes</option>
                    <option value="false" selected>No</option>');
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="block mx-left w-[150px] h-[40px] rounded bg-blue-500 hover:bg-blue-500/90" name="change_data">Save</button>
        </form>
        <div class="py-4">
            <h1 class="text-white font-bold text-2xl bg-[#338AFF] p-3 rounded-md">Alter Website Database Configuration</h1>
        </div>
        <form action="/ob-administrator/settings" method="post">
            <div class="grid grid-cols-2 gap-3">
                <div class="py-1">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-white">Database name</label>
                    <input type="text" name="website_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $config->getConfig()['database_name'] ?>" required>
                </div>
                <div class="py-1">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-white">Database username</label>
                    <input type="text" name="website_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $config->getConfig()['database_user'] ?>" required>
                </div>
                <div class="py-1">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-white">Database Port</label>
                    <input type="number" name="website_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $config->getConfig()['database_port'] ?>" required>
                </div>
                <div class="py-1 relative">
                    <label for="database_name" class="block mb-2 text-sm font-medium text-white">Database Password</label>
                    <input type="password" name="database_name" id="database_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $config->getConfig()['database_pass'] ?>" required>
                    <button type="button" class="absolute text-white top-1/2 right-2 transform -translate-y-1/2 focus:outline-none" onclick="togglePasswordVisibility()">
                        Show
                    </button>
                </div>

            </div>

        </form>
        <script>
            function togglePasswordVisibility() {
                const passwordInput = document.getElementById("database_name");
                const passwordIcon = document.querySelector("#database_name + button svg");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    passwordIcon.setAttribute("d", "M12 19l9 2-9-18-9 18 9-2zm-2.05-4.635a4 4 0 1 1 4.1 0l-.556 1.11a2 2 0 1 0-2.99 0l-.554-1.11z");
                } else {
                    passwordInput.type = "password";
                    passwordIcon.setAttribute("d", "M7 11V7a5 5 0 0 1 10 0v4m0 0v4a5 5 0 0 1-10 0v-4m0 0h10a3 3 0 0 1 0 6H7a3 3 0 0 1 0-6z");
                }
            }

        </script>
        <?php include __DIR__.'/../components/footer.php' ?>

    </div>
<?php
if(isset($_POST['change_data'])) {
    $config->configWrite('website_name', $_POST['website_name']);
    if(isset($_POST['website_description'])) {
        $config->configWrite('website_description', $_POST['website_description']);
    }
    $display_errors = false;
    if($_POST['display_errors'] == "true") {
        $display_errors = true;
    }
    $config->configWrite('debug_mode', $display_errors);


}

?>


</body>
</html>
