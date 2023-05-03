<?php
include(__DIR__.'/../components/navbar.php');


?>
<title>Profile | {{ name }}</title>
<main class="p-12 grid grid-cols-1 md:grid-cols-3">
    <div class="md:col-span-2 col-span-1">
        <img src="{{ profile_picture }}" alt="Profile picture" class="w-48 h-48 rounded-full object-cover">
        <h1 class="text-4xl md:text-6xl py-2 font-bold">{{ name }}</h1>
        <p class="py-2">{{ bio }}</p>
    </div>
    <div class="md:col-span-1 col-span-1">
        <h2 class="text-2xl font-bold py-3">Profile Information</h2>
        <ul class="list-disc list-inside">
            <li><b>Date Joined:</b> {{ join_date }}</li>
            <li><b>Last Online:</b> {{ last_online }}</li>
        </ul>
    </div>
</main>

