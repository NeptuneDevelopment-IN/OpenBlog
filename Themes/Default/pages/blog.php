
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ blog_title }}</title>

    <meta name="description" content="{{ blog_description }}" />
    <meta name="keywords" content="{{ tags }}" />
    <meta name="author" content="{{ author_name }}" />
    <meta name="application-name" content="Open Blog" />

    <meta property="og:title" content="{{ blog_title }}" />
    <meta property="og:description" content="{{ blog_description }}" />
    <meta property="og:type" content="article" />
    <meta property="article:author" content="//<?php echo($_SERVER['HTTP_HOST']) ?>/profile/{{ author_id }}">


    <meta itemprop="author" content="{{ author_name }}">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BlogPosting",
            "headline": "{{ blog_title }}",
            "datePublished": "{{ date_created_2 }}",
            "author": {
                "@type": "Person",
                "name": "{{ author_name }}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "{{ website_name }}"

            },
            "description": "This is a tutorial on how to use JSON-LD for a blog post.",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://example.com/blog/how-to-use-json-ld-for-a-blog-post"
            }
        }
    </script>

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ blog_title }}" />
    <meta name="twitter:description" content="{{ blog_description }}" />
    <meta name="twitter:image" content="{{ cover_image }}" />

</head>




<body class="">
<?php include(__DIR__.'/../components/navbar.php') ?>
    <article class="grid grid-cols-1 md:grid-cols-3 gap-6 container mx-auto px-4 my-6">

        <div class="md:col-span-2">
            <div class="border-b-2 border-l-2 bg-gray-100 border-gray-300 p-3 shadow-lg rounded-lg">
                <h1 class="font-bold text-4xl text-gray-700">{{ blog_title }}</h1>
                <p class="text-gray-600 pt-2 text-md"><b>Author</b> : <a class="underline hover:text-gray-800" href="/profile/{{ author_id }}">{{ author_name }}</a> at {{ date_created }}</p>
                <p class="text-gray-600 text-sm"><b>Tags</b> : {{ tags }}</p>
                <div class="py-1">
                    <span class="inline-block bg-gray-300 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">{{ category_name }}</span>

                </div>

            </div>
            <img src="{{ cover_image }}" class="w-full h-[300px] overflow-scroll shadow-lg rounded-lg" alt="{{ secondary_title }}">
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
    <?php include(__DIR__.'/../components/footer.php') ?>
</body>
</html>