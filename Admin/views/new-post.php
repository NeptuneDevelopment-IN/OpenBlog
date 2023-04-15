<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../OpenBlog/ThirdPartyLibs/Quill/quill.min.js"></script>
    <link rel="stylesheet" href="../../OpenBlog/ThirdPartyLibs/Quill/quill.snow.css">
    <title>Add a new post</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
    <?php

    require_once (__DIR__. '/../../OpenBlog/Loader.php');
    include(__DIR__ . '/../components/sidebar.php');
    require_once (__DIR__. '/../../OpenBlog/ConfigManager.php');
    $cm = new ConfigManager();
    $currentTheme = $cm->getConfig()['selected_theme'];
    $themeInfo = include(__DIR__ . "/../../Themes/{$currentTheme}/theme.php");
    $baseColor = $themeInfo['base_color'];
    $backgroundColor = $themeInfo['background_color'];
    ?>
    <div class="flex-col flex-1 p-6">
        <form action="/ob-administrator/blog-processor" method="POST">
            <div class="grid grid-cols-2 gap-4 pb-6">
                <div class="flex flex-col">
                    <label for="blog_title" class="text-white pb-2">Blog Title</label>
                    <input required type="text" name="blog_title" id="blog_title" class="h-[35px] p-3 bg-gray-300 outline-blue-500/50 rounded-md">
                </div>
                <div class="flex flex-col">
                    <label for="blog_secondary_title" class="text-white pb-2">Secondary Title</label>
                    <input required type="text" name="blog_secondary_title" id="blog_secondary_title" class="h-[35px] bg-gray-300 p-3 outline-blue-500/50	 rounded-md">
                </div>
            </div>

            <div id="editor-container" class="rounded"></div>
            <input type="hidden" required name="content" id="content-input">

            <div class="flex flex-col py-3">
                <label for="blog_secondary_title" class="text-white pb-2">Tags (Use Commas to Separate)</label>
                <input required type="text" name="tags" id="blog_secondary_title" class="h-[35px] bg-gray-300 p-3 outline-blue-500/50 rounded-md" placeholder="Tags">
            </div>

            <div class="p-3 block align-center text-center">
                <input type="submit" class="bg-yellow-300 hover:bg-yellow-200 p-3 rounded-full cursor-pointer w-[150px]" value="Submit">
                <input type="submit" class="bg-yellow-300 hover:bg-yellow-200 p-3 rounded-full cursor-pointer w-[150px] " formtarget="_blank" value="Preview">
            </div>
        </form>

        <script>
            var quill = new Quill('#editor-container', {
                // Quill configuration options
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['image', 'video'],
                        ['link'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'header': [1, 2, 3, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }],
                        ['clean']
                    ]
                },
                theme: 'snow'
            });

            // Add event listener to form submission
            document.querySelector('form').addEventListener('submit', function(event) {
                // Get the HTML content from Quill editor
                var content = quill.root.innerHTML;

                // Set the HTML content as the value of the hidden input field
                document.getElementById('content-input').value = content;
            });
        </script>
        <style>
            #editor-container {
                background-color: #f0f0f0;
                height: 500px;
            }

            .ql-toolbar {
                background-color: <?php echo($themeInfo['admin_textbox_bg_color']) ?>;
                border: 5px;
                border-radius: 5px;
            }

            .ql-toolbar .ql-stroke {
                fill: none;
                stroke: <?php echo($themeInfo['admin_textbox_toolbar_icon_color']) ?>;
                border: 5px;
                border-radius: 5px;
            }

            .ql-toolbar .ql-fill {
                fill: #fff;
                stroke: none;
                border: 5px;
                border-radius: 5px;
            }

            .ql-toolbar .ql-picker {
                color: #000000;
            }
            .ql-toolbar .ql-picker-label {
                color: #fff;
            }

            .ql-toolbar .ql-picker-item {
                color: #000000;
            }
        </style>

    </div>
</body>
</html>