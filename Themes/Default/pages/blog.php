<main class="">
    <title>{{ blog_title }}</title>
    <article class="grid grid-cols-1 md:grid-cols-3 p-6 ">

        <div class="md:col-span-2">
            <div class="border-b-2 border-l-2  border-gray-300 p-3">
                <h1 class="font-bold text-4xl">{{ blog_title }}</h1>
                <p><a class="underline" href="/profile/{{ author_id }}">{{ author_name }}</a> at {{ date_created }}</p>
                <p><b>Tags</b> : {{ tags }}</p>
            </div>
            <div class="pt-6 border-2 border-gray-300">
                {{ content }}
            </div>
        </div>
        <div class="border-b-4 bg-gray-300 rounded-lg">
            <h3 class="font-bold text-center bg-green-400"  >About The Author</h3>
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
        body {
            background-color: #E6F1EA;
        }
    </style>

</main>