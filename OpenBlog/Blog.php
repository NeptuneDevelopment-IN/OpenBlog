<?php 
require_once('Database.php');

class Blog
{
    protected $db;

    //Connect to the database
    public function __construct() {
        // Make a connection to the database server.
        $this->db = new Database();
    }

    // Get the blog by filtering it through the database and returning the data as an array.
    public function getBlog($id) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blog_data WHERE slug = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
        if ($data) {
            return $data;
        }
        return false;
    }

    public function getBlogById($id) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blog_data WHERE blog_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
        if ($data) {
            return $data;
        }
        return false;
    }

    //Function to get latest 'n' number the blogs from the server as an array
    public function getNumBlogs($limit = 10) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blog_data ORDER BY date_created DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $data = array();
            while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }

        return false;
    }


    public function getNumCategories($limit = 10) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blog_categories LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $data = array();
            while ($row = $res->fetch_array()) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getCategory($category_id) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blog_categories WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $data = array();
            while ($row = $res->fetch_array()) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function generateBlogID(): string {
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

    public function blogIDExists($blog_id): bool {
        $stmt = $this->db->conn->prepare("SELECT blog_id FROM blog_data WHERE blog_id=?");
        $stmt->bind_param("s", $blog_id);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->close();
        return $count > 0;
    }


    public function addBlog($title, $secondary_title, $content, $author, $tags, $category_id, $description, $banner_url) {

        $date_created = time();
        $blog_id = $this->generateBlogID();
        $url_id = $this->slugify($title);
        $url_id = $url_id."-{$blog_id}";
        $stmt = $this->db->conn->prepare("INSERT INTO blog_data (title, secondary_title, content, author, blog_id, date_created, likes, dislikes, tags, category, description, banner_url, slug) VALUES (?, ?, ?, ?, ?, ?, 0, 0, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssisssss", $title, $secondary_title, $content, $author, $blog_id, $date_created, $tags, $category_id, $description, $banner_url, $url_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo("<h1 class='text-3xl text-center'> Blog Added Successfully! <br> <a href='/blog/{$blog_id}'>Blog Link</a></h1>");
        }

        $stmt->close();
    }

    public function updateBlog($id, $title, $sec_title, $tags, $category, $content) {
        $content = mysqli_real_escape_string($this->db->conn, $content);
        $stmt = $this->db->conn->prepare("UPDATE blog_data SET title=?, secondary_title=?, tags=?, category=?, content=? WHERE blog_id=?");
        $stmt->bind_param("sssssi", $title, $sec_title, $tags, $category, $content, $id);
        $stmt->execute();
        if($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

    private function slugify($string): string {
            // Remove any special characters and replace spaces with hyphens
            $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
            $string = strtolower(str_replace(' ', '-', $string));

            // Remove any consecutive hyphens
            $string = preg_replace('/-+/', '-', $string);

            // Trim any leading or trailing hyphens
            $string = trim($string, '-');

            return $string;
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