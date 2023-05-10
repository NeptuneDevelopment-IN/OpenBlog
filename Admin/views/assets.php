<?php
require_once (__DIR__.'/../utils/loader.php');

ini_set('post_max_size', '50M');
ini_set('upload_max_filesize', '50M');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Assets To The Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/OpenBlog/ThirdPartyLibs/jQuery/jquery-3.6.4.min.js"></script>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
<?php include(__DIR__.'/../components/sidebar.php'); ?>
<div class="flex-col flex-1 p-6">
    <h1 class="text-gray-200 font-bold text-3xl">Upload Assets to the Server</h1>
    <p class="text-gray-200 font-semibold">Note: These files are publicly accessible to anyone. Do not use this thing as a cloud storage!</p>
    <div class="w-full max-w-xs">
        <form id="upload-form" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="file">
                    Select file to upload:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="file" type="file" name="file" accept="image/*">
            </div>
            <div class="flex items-center justify-between">
                <button id="upload-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Upload
                </button>
                <div id="progress-bar" class="bg-gray-200 h-3 rounded-full w-3/4 ml-4">
                    <div class="bg-blue-500 h-3 rounded-full" style="width: 0%"></div>
                </div>
                <div id="message"></div>
            </div>
        </form>
    </div>


    <hr class="my-3">
    <script>
        const fileInput = document.getElementById('file');
        const uploadButton = document.getElementById('upload-button');
        const progressBar = document.getElementById('progress-bar').querySelector('.bg-blue-500');
        const message = document.getElementById('message');

        uploadButton.addEventListener('click', function() {
            const file = fileInput.files[0];
            if (!file) return;
            const xhr = new XMLHttpRequest();
            const formData = new FormData();
            formData.append('file', file);

            xhr.open('POST', '/ob-administrator/assets');
            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    const progress = event.loaded / event.total * 100;
                    progressBar.style.width = `${progress}%`;
                }
            });

            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4) {
                    progress.style.display = 'none';

                    if (xhr.status === 200) {
                        message.textContent = xhr.responseText;
                    } else {
                        message.textContent = 'Error uploading file';
                    }
                }
            };

            xhr.addEventListener('load', function() {
                console.log(xhr.responseText);
            });
            xhr.addEventListener('error', function() {
                console.error('An error occurred while uploading the file.');
            });
            xhr.send(formData);
        });

    </script>
    <div>
        <h1 class="text-gray-200 font-bold text-3xl">Files on the server</h1>
        <?php
        $dir = '/Assets/userassets';

        // Get all files and directories in the specified directory
        $files = scandir($_SERVER['DOCUMENT_ROOT'] . $dir);

        // Filter out directories and non-image and non-video files
        $files = array_filter($files, function($file) {
            return !is_dir($file) && preg_match('/\.(jpg|jpeg|png|gif|mp4|avi|mkv)$/i', $file);
        });

        // Output the file names as links (assuming Tailwind CSS is already included)
        echo '<div class="grid grid-cols-3 gap-4 py-2">';
        foreach ($files as $file) {
            $path = $dir . '/' . $file; // Set the path
            echo '<a target="_blank" href="' . $path . '" class="border-2 text-gray-200 border-gray-400 p-2 hover:border-blue-500 transition-all duration-300">' .
                '<p class="mt-2">' . $file . '</p>' .
                '</a>';
        }
        echo '</div>';
        ?>

</div>
    <?php include __DIR__.'/../components/footer.php' ?>

</div>
<style>
    body {
        background-color: #1a202c;
    }
    form {
        margin: 20px auto;
        max-width: 500px;
        padding: 20px;
        background-color: #2d3748;
        border-radius: 5px;
    }
    input[type="file"] {
        margin-bottom: 10px;
    }
    progress {
        width: 100%;
        height: 20px;
        margin-bottom: 10px;
    }

</style>

</body>
</html>