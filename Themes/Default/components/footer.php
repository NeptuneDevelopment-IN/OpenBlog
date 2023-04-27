<?php
require_once(__DIR__.'/../../../OpenBlog/ConfigManager.php');
$config = new ConfigManager();
$website_name = $config->getConfig()['website_name'];
$website_description = $config->getConfig()['website_description'];

?>
<footer class="sticky top-[100vh] w-full pt-6 drop-shadow-xl">
    <div class="flex items-center justify-center bg-[#E6F1EA]">
    <div class="flex flex-col">
        <div class="flex mt-12 mb-12 flex-row justify-between">
            <a href="https://github.com/NeptuneDevelopment-IN" class=" px-2 md:block cursor-pointer text-gray-800 hover:text-green-500 uppercase">GITHUB</a>
            <a href="https://github.com/NeptuneDevelopment-IN/OpenBlog" class=" px-2 md:block cursor-pointer text-gray-800 hover:text-green-500 uppercase">OPEN BLOG</a>
            <a href="/" class=" px-2 md:block cursor-pointer text-gray-800 hover:text-green-500 uppercase">Newsletter</a>
        </div>
        <hr class="border-gray-600"/>
        <div class="my-8">
            <p class="w-full text-center text-gray-800">Running on Open Blog</p>
            <p class="w-full text-center text-gray-800">Copyright © 2023 Neptune Development</p>
        </div>
    </div>
    </div>
</footer>