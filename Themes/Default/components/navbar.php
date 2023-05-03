<!-- Navbar goes here -->

<?php
require_once(__DIR__ . '/../../../OpenBlog/ConfigManager.php');
$config = new ConfigManager();

$website_name = $config->getConfig()['website_name'];
$website_description = $config->getConfig()['website_name'];

?>

<nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <!-- Website Logo -->
                    <a href="/" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-lg"><?php echo $website_name ?></span>
                    </a>
                </div>
                <!-- Primary Navbar items -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Home</a>
                    <a href="/authors" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Authors</a>
                    <a href="/contact" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Contact Us</a>
                </div>
            </div>
            <!-- Secondary Navbar items -->
            <div class="hidden md:flex items-center space-x-3 ">
                <?php
                require_once(__DIR__. '/../../../OpenBlog/Authenticator.php');
                $auth = new Authenticator();
                if($auth->isLoggedIn()) {
                    $user_id = $_SESSION['user_id'];
                    $nickname = $_SESSION['nickname'];
                    echo ("<a href='/profile' class='py-2 px-2 font-medium text-gray-500 rounded hover:bg-green-500 hover:text-white transition duration-300'>{$nickname}</a>");
                } else {
                    echo("<a href='/login' class='py-2 px-2 font-medium text-gray-500 rounded hover:bg-green-500 hover:text-white transition duration-300'>Log In</a>
                <a href='/signup' class='py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300'>Sign Up</a>");
                }

                ?>

            </div>
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                    <svg class=" w-6 h-6 text-gray-500 hover:text-green-500 "
                         x-show="!showMenu"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- mobile menu -->
    <div class="hidden mobile-menu">
        <ul class="">
            <li><a href="/" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Home</a></li>
            <li><a href="/authors" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Authors</a></li>
            <li><a href="/contact" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Contact Us</a></li>
        </ul>
    </div>
    <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script>
</nav>