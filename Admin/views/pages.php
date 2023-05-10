<script src="https://cdn.tailwindcss.com"></script>
<?php
require_once (__DIR__.'/../utils/loader.php');

include(__DIR__.'/../components/sidebar.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Pages</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
<div class="flex-col flex-1 p-6">
    <h1 class="p-3 text-white font-bold text-2xl bg-[#338AFF] rounded-md">Add or Remove Custom Pages for your website</h1>
    <div>
        <form action="/ob-administrator/pages"  method="post" class="py-3">
            <h1 class="text-white font-bold text-xl">Create a Custom Page</h1>
            <div class="my-3">
                <label for="page_path" class="text-white font-bold">URL Path</label>
                <input type="text" name="page_path" id="page_path" class="h-[35px] p-3 w-full rounded-md">
            </div>
        </form>
    </div>
    <?php include __DIR__.'/../components/footer.php' ?>

</div>
</body>
</html>
