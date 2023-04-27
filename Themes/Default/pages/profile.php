<?php
include(__DIR__.'/../components/navbar.php');


?>
<title>Profile | {{ name }}</title>
<main class="p-12 grid grid-cols-3">
    <div class="md:col-span-2 col-span-3">
        <h1 class=" text-4xl md:text-6xl py-2 font-bold inline-flex">{{ name }}</h1>
        <p class="py-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur cupiditate dicta illum ipsam minus molestias nulla obcaecati vel veniam voluptatibus.</p>
        <h1 class="text-2xl font-bold py-3">Information</h1>
        <p class=""><b>Date Joined</b> : {{ join_date }}</p>
        <p class=""><b>Last Online</b> : {{ last_online }}</p>
        <p class=""><b>Administrator</b> : {{ is_admin }}</p>

    </div>
</main>
<div class="p-12">
    <a href="/logout" class="p-3 w-[100px] rounded-full bg-red-300">Log Out</a>
</div>