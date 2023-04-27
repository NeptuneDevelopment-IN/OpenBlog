<?php
require_once(__DIR__.'/../../../OpenBlog/ConfigManager.php');
$config = new ConfigManager();
$website_name = $config->getConfig()['website_name'];
$website_description = $config->getConfig()['website_description'];

?>
<footer class="sticky top-[100vh] w-full pt-6 drop-shadow-xl">
    <div class="bg-gray-300">
        <div class="grid grid-cols-1 md:grid-cols-5">
            <div class="p-3">
                <h1 class="col-span-3 font-bold text-2xl text-center md:text-left"><?php echo $website_name ?></h1>
                <p class="text-base text-center md:text-left"><?php echo $website_description ?></p>
            </div>
        </div>
        <h1 class="text-center py-3 font-bold">&copy; 2023 Neptune Development | <a href="https://github.com/NeptuneDevelopment-IN/OpenBlog" class="underline">Open Blog</a> [v1.0]</h1>

    </div>
</footer>