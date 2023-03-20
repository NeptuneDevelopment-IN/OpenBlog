<?php
require_once(__DIR__ . "/../OpenBlog/ThemeManager.php");
require_once(__DIR__ . "/../OpenBlog/ConfigManager.php");
$config = new ConfigManager();
$theme = new ThemeManager();


// Read the contents of the JSON file into a string
$jsonData = file_get_contents(__DIR__. "/../config.json");

// Decode the JSON data into a PHP object
$config = json_decode($jsonData);
// Access the value of the "is_installed" key
$isInstalled = $config->is_installed;









