<?php
if(!$_SESSION['is_admin'] && !$_SESSION['is_logged_in']) {
    exit('Access Denied');
}
require_once (__DIR__. '/../../OpenBlog/Loader.php');


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Open Blog Administration Panel</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
<?php include(__DIR__. '/../components/sidebar.php')?>
<div class="flex-col flex-1 p-6">
    <div class="flex block">
        <h1 class="text-white text-2xl font-bold w-full">Administrator Dashboard</h1>
        <a href="/ob-administrator/new" class="float-right flex-none block">
            <button class="bg-white rounded-full p-2">
                New Post
            </button>
        </a>
    </div>
    <div class="grid grid-cols-2 gap-6">
        <div class="pt-6">
            <div class="bg-gray-700 w-full p-3 font-bold text-lg text-gray-300 rounded-t-md">
                Your Recent Posts
            </div>
            <div class="divide-y divide-slate-400 ">
                <div class="bg-gray-500 hover:bg-gray-600 cursor-pointer transition duration-200 p-3">
                    <h1 class="font-bold text-lg text-gray-200 truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, vero.</h1>
                    <p class="truncate text-gray-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet assumenda at, ea expedita nulla porro praesentium saepe sint unde vel?</p>
                </div>
                <div class="bg-gray-500 hover:bg-gray-600 cursor-pointer transition duration-200 p-3">
                    <h1 class="font-bold text-lg text-gray-200 truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, vero.</h1>
                    <p class="truncate text-gray-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet assumenda at, ea expedita nulla porro praesentium saepe sint unde vel?</p>
                </div>
                <div class="bg-gray-500 hover:bg-gray-600 cursor-pointer transition duration-200 p-3">
                    <h1 class="font-bold text-lg text-gray-200 truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, vero.</h1>
                    <p class="truncate text-gray-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet assumenda at, ea expedita nulla porro praesentium saepe sint unde vel?</p>
                </div>
            </div>
        </div>
        <div class="pt-6">
            <div class="bg-gray-700 font-bold w-full p-3 text-lg text-gray-300 rounded-t-md">
                Statistics
            </div>
            <div>
                <table class="w-full border border-slate-500">
                    <tr>
                        <td class="p-3 text-gray-300 font-bold border border-slate-500">Total Posts</td>
                        <td class="p-3 text-gray-300 text-center border border-slate-500">24</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-gray-300 font-bold border border-slate-500">Registered Users</td>
                        <td class="p-3 text-gray-300 text-center border border-slate-500">24</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-gray-300 font-bold border border-slate-500">Open Blog Version</td>
                        <td class="p-3 text-gray-300 text-center border border-slate-500">1.0-ALPHA</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-gray-300 font-bold border border-slate-500">MySQL Database Connection</td>
                        <td class="p-3 text-gray-300 text-center border border-slate-500">Working!</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</div>


</body>
</html>
