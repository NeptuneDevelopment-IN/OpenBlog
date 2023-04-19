<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../OpenBlog/ThirdPartyLibs/Quill/quill.min.js"></script>
    <link rel="stylesheet" href="../../OpenBlog/ThirdPartyLibs/Quill/themes/quill.snow.css">

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
        <form action="/ob-administrator/blog-processor" method="POST" >
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

            <div id="editor-container" class="rounded">
            </div>
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
                    toolbar: {
                        container: [
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'align': [] }],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'header': [1, 2, 3, false] }],
                            ['link', 'image', 'video', 'formula'],
                            ['clean']
                        ],

                    }

                },
                theme: 'snow',

            });



            function selectLocalImage() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('multiple', 'multiple');
                input.setAttribute('accept', 'image/png, image/gif, image/jpeg, image/webp')
                input.click();

                // Listen upload local image and save to server
                input.onchange = () => {
                    const fileList = Array.from(input.files);
                    saveToServer(fileList);
                }
            }

            function saveToServer(files) {
                const formData = new FormData();
                files.forEach(file => formData.append('images[]', file));

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '//' + window.location.host + '/ob-administrator/upload-img', true);
                xhr.onload = () => {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        const data = JSON.parse(xhr.responseText).data;
                        data.forEach(url => insertToEditor(url));
                    }
                };
                xhr.send(formData);
            }

            function insertToEditor(url) {
                // push image url to rich editor.
                const range = quill.getSelection();
                quill.insertEmbed(range.index, 'image', url);
            }

            // quill editor add image handler
            quill.getModule('toolbar').addHandler('image', () => {
                selectLocalImage();
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