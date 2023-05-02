<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
</head>
<body>
 <?php
 include(__DIR__.'/../../components/navbar.php'); ?>
 <h1 class="text-center font-bold text-3xl py-6">Register</h1>
 <div class="flex items-center justify-center">
     <div class=" bg-gray-200 rounded-md border-2 border-gray-500">
         <form action="/signup" class="p-6" method="post">
             <div class="p-3">
                 <input class="rounded-md w-[230px] h-[40px] p-2" type="text" name="nickname" id="nickname" placeholder="Nickname">
             </div>
             <div class="p-3">
                 <input class="rounded-md w-[230px] h-[40px] p-2" type="email" name="email_address" id="email_address" placeholder="Email Address">
             </div>
             <div class="p-3">
                 <input class="rounded-md w-[230px] h-[40px] p-2"  type="password" name="password" id="password" placeholder="Password">
             </div>
             <div class="p-3">
                 <input class="rounded-md w-[230px] h-[40px] p-2"  type="password" name="confirm_password" id="password" placeholder="Repeat Password">
             </div>
             <input type="submit" value="Register" class="block mx-auto bg-green-500 hover:bg-green-600 cursor-pointer w-[150px] h-[40px] rounded-md">
         </form>
     </div>
 </div>
</body>
</html>