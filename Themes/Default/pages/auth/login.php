<?php include(__DIR__.'/../../components/navbar.php') ?>
<h1 class="text-center font-bold text-3xl py-6">Login to Open Blog</h1>
<div class="flex items-center justify-center">
    <div class=" bg-gray-200 rounded-md border-2 border-gray-500">
        <form action="/login" class="p-6" method="post">
            <div class="p-3">
                <input class="rounded-md w-[230px] h-[40px] p-2" type="email" name="email_address" id="email_address" placeholder="Email Address">
            </div>
            <div class="p-3">
                <input class="rounded-md w-[230px] h-[40px] p-2"  type="password" name="password" id="password" placeholder="Password">
            </div>
            <input type="submit" value="Login" class="block mx-auto bg-green-500 hover:bg-green-600 cursor-pointer w-[150px] h-[40px] rounded-md">
        </form>
    </div>
</div>