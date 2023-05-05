<?php 
require_once('Database.php');

class Blog
{
    protected $db;

    //Connect to the database
    public function __construct()
    {
        // Make a connection to the database server.
        $this->db = new Database();
    }

    // Get the blog by filtering it through the database and returning the data as an array.
    public function getBlog($id)
    {
        $data = $this->db->conn->query("SELECT * FROM blog_data WHERE blog_id ='{$id}'");
        if (mysqli_num_rows($data) > 0) {
            $row = mysqli_fetch_array($data);
            $blog = array(
                'title' => $row['title'],
                'secondary_title' => $row['secondary_title'],
                'content' => $row['content'],
                'author' => $row['author'],
                'id' => $row['blog_id'],
                'date_created' => $row['date_created'],
                'likes' => $row['likes'],
                'dislikes' => $row['dislikes'],
                'tags' => $row['tags'],
                'category' => $row['category']
            );
            return $blog;
        }
        return false;
    }

    //Function to get latest 'n' number the blogs from the server as an array
    public function getNumBlogs($limit = 10)
    {
        $sql = "SELECT * FROM blog_data LIMIT {$limit}";
        $res = $this->db->conn->query($sql);
        if (mysqli_num_rows($res) > 0) {
            $data = array();
            while ($row = mysqli_fetch_array($res)) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }

    public function getNumCategories($limit = 10)
    {
        $sql = "SELECT * FROM blog_categories LIMIT {$limit}";
        $res = $this->db->conn->query($sql);
        if (mysqli_num_rows($res) > 0) {
            $data = array();
            while ($row = mysqli_fetch_array($res)) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }


    public function getCategory($category_id) {
        $sql = "SELECT * FROM blog_categories WHERE category_id={$category_id}";
        $res = $this->db->conn->query($sql);
        if (mysqli_num_rows($res) > 0) {
            $data = array();
            while ($row = mysqli_fetch_array($res)) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }

    public function generateBlogID(): string
    {
        $blog_id = $this->generateRandomID();
        // Check if the user ID already exists in the database
        while ($this->blogIDExists($blog_id)) {
            // If it exists, generate a new user ID and check again
            $user_id = $this->generateRandomID();
        }
        return $blog_id;
    }

    public function generateRandomID(): string {
        $id = "";
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for ($i = 0; $i < 16; $i++) {
            $id .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $id;
    }

    public function blogIDExists($blog_id): bool
    {
        $qqq = $this->db->conn->query("SELECT blog_id FROM blog_data WHERE blog_id='{$blog_id}'");
        if (mysqli_num_rows($qqq) == 1) {
            return true;
        }
        return false;
    }

    public function addBlog($title, $secondary_title, $content, $author, $tags, $category_id) {
        $content = mysqli_real_escape_string($this->db->conn, $content);
        $date_created = time();
        $blog_id = $this->generateBlogID();
        $sql = "INSERT INTO blog_data ( title, secondary_title, content, author, blog_id, date_created, likes, dislikes, tags, category)
        VALUES ('{$title}', '{$secondary_title}', '{$content}', '{$author}', '{$blog_id}', '${date_created}', '0', '0', '{$tags}', '{$category_id}') ";
        $query = $this->db->conn->query($sql);
        if($query) {
            echo("<h1 class='text-3xl text-center'> Blog Added Successfully! <br> <a href='/blog/{$blog_id}'>Blog Link</a></h1>");
        }
        echo(mysqli_error($this->db->conn));


    }
    public function updateBlog($id, $title, $sec_title, $tags, $category, $content) {
        $content = mysqli_real_escape_string($this->db->conn, $content);
        $sql = "UPDATE blog_data SET title='{$title}', secondary_title='{$sec_title}', tags='{$tags}', category={$category}, content='{$content}' WHERE blog_id='{$id}'";
        $stmt = $this->db->conn->query($sql);
        if($stmt) {
            return true;
        }
        return false;

    }

    public function getBlogByCategory($cat_id) {
        $sql = "SELECT * FROM blog_data WHERE category=?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $blog_data = mysqli_fetch_all($res, MYSQLI_ASSOC);

        $sql_2 = "SELECT * FROM blog_categories WHERE category_id=?";
        $stmt_2 = $this->db->conn->prepare($sql_2);
        $stmt_2->bind_param("i", $cat_id);
        $stmt_2->execute();
        $res_2 = mysqli_fetch_assoc($stmt_2->get_result());

        $ret_data = array(
            'category' => $res_2,
            'blogs' => $blog_data,
        );
        return $ret_data;
    }




}