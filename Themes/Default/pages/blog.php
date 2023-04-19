<main>

    <link rel="stylesheet" href="../../../OpenBlog/ThirdPartyLibs/Quill/quill.snow.css">
    <div class="grid grid-cols-1 md:grid-cols-3 p-6 ">

        <div class="p-6 md:col-span-2 bg-gray-300 rounded-lg">
            <h1 class="text-3xl font-bold pb-3">{{ blog_title }}</h1>
            {{ content }}
            <a href="/profile/{{ author_id }}">Author</a>
        </div>
    </div>

</main>