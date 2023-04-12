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
    <?php include(__DIR__ . '/../components/sidebar.php') ?>
    <div class="flex-col flex-1 p-6">
        <form action="/ob-administrator/blog-processor" method="GET">
            <label for="blog_title">Blog Title</label>
            <input type="text" name="blog_title" id="blog_title">
            <label for="blog_secondary_title">Seondary Title</label>
            <input type="text" name="blog_secondary_title" id="blog_secondary_title">
            <div id="editor-container" class="rounded"></div>

            <input type="hidden" name="content" id="content-input">
            <input type="submit" value="Submit">
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
                background-color: #f0f0f0; /* Replace with your desired background color */
                height: 500px; /* Set a height for the editor container */
            }

            .ql-toolbar {
                background-color: #4D4E54; /* Replace with your desired background color */
                border: 5px;
                border-radius: 5px;
            }

            .ql-toolbar .ql-stroke {
                fill: none;
                stroke: #fff;
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