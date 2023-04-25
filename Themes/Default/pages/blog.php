<main>
    <title>{{ blog_title }}</title>
    <article class="grid grid-cols-1 md:grid-cols-3 p-6 ">
        <div class="p-1 md:col-span-2 border-x-4 ">
            <div class="bg-gray-200 p-4 rounded-md">
                <h1 class="text-3xl font-bold pb-3">{{ blog_title }}
                <h1 class="text-xl pb-3">{{ secondary_title }}</h1>
            </div>
            <div class="overflow-hidden">
                {{ content }}
            </div>
        </div>
        <div class="border-b-4">
            <h3 class="font-bold text-center bg-green-400">About The Author</h3>
            <h3 class="pl-6 font-bold pt-3">{{ author_name }}</h3>
            <p class="pl-6"><b>Date Joined</b>: {{ author_join }}</p>
            <p class="pl-6"><b>Administrator</b>: {{ is_admin }}</p>
            <p class="py-3">{{ author_bio }}</p>
        </div>
    </article>
    <style>
        table {
            align-content: center;
            margin: auto;
            border-width: 2px;
        }
        td {
            padding: 5px;
            border-width: 2px;

        }
    </style>

</main>