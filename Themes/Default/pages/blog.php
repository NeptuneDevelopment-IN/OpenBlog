<main class="container mx-auto px-4 my-6">
    <article class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="md:col-span-2">
            <div class="border-b-2 border-l-2 bg-gray-100 border-gray-300 p-3 shadow-lg rounded-lg">
                <h1 class="font-bold text-4xl text-gray-700">{{ blog_title }}</h1>
                <p class="text-gray-600 pt-2 text-md"><b>Author</b> : <a class="underline hover:text-gray-800" href="/profile/{{ author_id }}">{{ author_name }}</a> at {{ date_created }}</p>
                <p class="text-gray-600 text-sm"><b>Tags</b> : {{ tags }}</p>
                <div class="py-1">
                    <span class="inline-block bg-gray-300 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">{{ category_name }}</span>

                </div>
            </div>
            <div class="pt-6 px-3 border-2 border-gray-300 shadow-lg">
                {{ content }}
            </div>
        </div>

        <div>
            <div class="bg-gray-100 rounded-lg p-4 shadow-lg">
                <h3 class="font-bold text-lg bg-green-400 py-2 px-4 rounded-md mb-4">About The Author</h3>
                <h3 class="font-bold">{{ author_name }}</h3>
                <p class="text-gray-800 text-sm"><b>Date Joined</b>: {{ author_join }}</p>
                <p class="text-gray-800 text-sm"><b>Administrator</b>: {{ is_admin }}</p>
                <p class="py-3">{{ author_bio }}</p>
            </div>
        </div>
    </article>
    <style>
        body {
            background-color: #E1E2E5;
        }
    </style>
</main>