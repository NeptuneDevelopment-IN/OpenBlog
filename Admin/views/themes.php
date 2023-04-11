
<?php
include(__DIR__. '/../../Admin/components/sidebar.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Themes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex-wrap flex bg-[#1C2033]">
    <div class="flex-col">
        <h1 class="text-white font-bold text-2xl p-6">Customize Your Website Theme</h1>

        <div class="relative inline-block px-6">
            <button id="dropdown-button" class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center transition duration-300 ease-in-out transform hover:bg-gray-400 hover:text-gray-900 focus:outline-none focus:shadow-outline">
                <span>Themes</span>
                <svg class="fill-current h-4 w-4 ml-2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 8l4 4 4-4"></path>
                </svg>
            </button>
            <ul id="dropdown-menu" class="hidden absolute text-gray-700 pt-1 transition duration-300 ease-in-out transform origin-top-right scale-0">
                <?php
                require_once(__DIR__ . '/../../OpenBlog/ThemeManager.php');
                $theme = new ThemeManager();
                $themeList = $theme->getThemes();
                for($i = 0; count($themeList) > $i; $i++) {
                    $theme_name = $themeList[$i];
                    echo("<li><a class=' bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap' href='#'>$theme_name</a></li>");
                }
                ?>
            </ul>
        </div>
    </div>

    <script>// Get the dropdown button and menu elements
        // Get the dropdown button and menu elements
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Toggle the "hidden" class on the dropdown menu when the button is clicked, and apply an animation
        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
            dropdownMenu.classList.toggle('scale-0');
            dropdownMenu.classList.toggle('scale-100');
        });

        // Hide the dropdown menu when the user clicks outside of it, and apply an animation
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('scale-0');
                dropdownMenu.classList.remove('scale-100');
                setTimeout(() => {
                    dropdownMenu.classList.add('hidden');
                }, 300); // Wait for animation to complete
            }
        });

    </script>


    <style>
        /* Button styles */
        button {
            transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
        }
        button:hover {
            background-color: #cbd5e0;
            transform: translateY(-1px);
        }
        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }

        /* Dropdown menu styles */
        ul {
            transform-origin: top right;
            animation-name: dropdown;
            animation-duration: 0.3s;
            animation-timing-function: ease-in-out;
            animation-fill-mode: forwards;
            opacity: 0;
            transform: scaleY(0);
        }
        ul.show {
            animation-name: dropdown-show;
            opacity: 1;
            transform: scaleY(1);
        }
        li a {
            display: block;
        }
        @keyframes dropdown {
            from {
                opacity: 0;
                transform: scaleY(0);
            }
            to {
                opacity: 1;
                transform: scaleY(1);
            }
        }
        @keyframes dropdown-show {
            from {
                opacity: 0;
                transform: scaleY(0);
            }
            to {
                opacity: 1;
                transform: scaleY(1);
            }
        }

    </style>
</body>
</html>
