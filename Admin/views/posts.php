
<?php
require_once (__DIR__. '/../../OpenBlog/Loader.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Posts</title>
</head>
<body class="bg-[#1C2033] flex flex-wrap">
    <?php include(__DIR__ . '/../components/sidebar.php'); ?>
    <div class="flex-col flex-1 p-6">
        <h1 class="text-white font-bold text-3xl">Blog Posts</h1>
        <div class="py-4">
            <h1 class="text-white font-bold text-2xl bg-[#338AFF] p-3 rounded-md">Add, edit, or delete blogs on the website</h1>
        </div>

        <?php
        require_once(__DIR__.'/../../OpenBlog/Database.php');
        require_once(__DIR__.'/../../OpenBlog/Blog.php');

        $blog = new Blog();
        $db = new Database();

        $sql = "SELECT COUNT(*) as total_records FROM blog_data";
        $res = $db->conn->query($sql);
        $row = mysqli_fetch_assoc($res);
        $total_records = $row['total_records'];
        $records_per_page = $_GET['per_page'] ?? 10;
        $current_page = $_GET['page'] ?? 1;
        $total_pages = ceil($total_records / $records_per_page);
        $offset = ($current_page - 1) * $records_per_page;
        $sql = "SELECT * FROM blog_data LIMIT {$offset}, {$records_per_page}";
        $res = $db->conn->query($sql);
        $data = mysqli_fetch_all($res, MYSQLI_ASSOC);

        ?>

        <div class="container mx-auto py-4">

            <div class="flex justify-between items-center mb-4">
                <form action="" method="get" class="flex items-center">
                    <label for="per_page" class="text-gray-100 mr-2">Per Page:</label>
                    <select name="per_page" id="per_page" class="rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="10" <?php if($records_per_page == 10) echo 'selected'; ?>>10</option>
                        <option value="20" <?php if($records_per_page == 20) echo 'selected'; ?>>20</option>
                        <option value="50" <?php if($records_per_page == 50) echo 'selected'; ?>>50</option>
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Go</button>
                </form>
                <div>
                    <span class="mr-2 text-gray-100">Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></span>
                    <?php if($current_page > 1): ?>
                        <a href="?page=<?php echo $current_page - 1; ?>&per_page=<?php echo $records_per_page; ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded-l">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php endif; ?>

                    <?php if($current_page < $total_pages): ?>
                        <a href="?page=<?php echo $current_page + 1; ?>&per_page=<?php echo $records_per_page; ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded-r">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="border-t border-gray-300"></div>

            <div class="my-4">
                <?php foreach($data as $post): ?>
                    <div class="inline-flex bg-[#3F4D72] p-3 rounded-md w-full">
                        <div class="w-full">
                            <h1 class="text-gray-200 font-bold text-xl"><?php echo($post['title']) ?></h1>
                            <p class="text-gray-300"><?php echo($post['secondary_title']) ?></p>
                        </div>
                        <a href="/ob-administrator/posts/<?php echo($post['blog_id']) ?>">
                            <button class="flex bg-[#5675C8] p-3 hover:bg-[#5675C8]/90 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                Edit
                            </button>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination flex justify-between items-center mt-4">
                <?php if ($current_page > 1): ?>
                    <a href="?page=<?php echo $current_page - 1; ?>&per_page=<?php echo $records_per_page; ?>" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-l">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                <?php endif; ?>

                <div class="flex items-center">
                    <span class="mr-2 text-white">Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></span>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>&per_page=<?php echo $records_per_page; ?>" class="btn <?php echo ($current_page == $i) ? 'bg-blue-500 text-white font-bold py-2 px-4 rounded' : 'bg-gray-200 hover:bg-gray-300 text-gray-600 font-bold py-2 px-4'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?php echo $current_page + 1; ?>&per_page=<?php echo $records_per_page; ?>" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>



</body>
</html>