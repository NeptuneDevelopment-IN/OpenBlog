<?php
/*
 * Checks if the user is directly accessing the file.
 * If yes it will immediately stop the execution of the page and show a warning
 */

if (!defined('REQUEST_FROM_INDEX') || REQUEST_FROM_INDEX !== true) {
    // Show warning or take appropriate action
    echo "
<script src=\"https://cdn.tailwindcss.com\"></script>
<div class='p-6 w-full'>
    <h1 class='text-red-500 text-3xl font-bold text-center p-3 rounded-md bg-gray-300'>Warning: Invalid Request</h1>
</div>";
    exit();
}


require_once(__DIR__.'/ConfigManager.php');
$config = new ConfigManager();

function errorHandlerOpenBlog() {
    global $currentTheme;
    header("Location: /internal-error");
    die(); // stop script execution

}

if(!$config->getConfig()['debug_mode']) {
    ini_set('display_errors', false);
    set_error_handler("errorHandlerOpenBlog");
}

echo('<script src="https://cdn.tailwindcss.com"></script>');



//Error Handler



