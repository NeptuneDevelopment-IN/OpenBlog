<?php 
require_once('Database.php');

class Blog {
    protected $db;
    
    //Connect to the database
    public function __construct() {
        // Make a connection to the database server.
        $this->db = new Database();
    }
    
    // Get the blog by filtering it through the database and returning the data as an array.
    public function getBlog($id) {
        $data = $this->db->conn->query("SELECT * FROM blog_data WHERE blog_id ='{$id}'");
        if(mysqli_num_rows($data) > 0) {
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
            );
            return $blog;
        }
        return false;
    }

    //Function to get latest 'n' number the blogs from the server as an array
    public function getNumBlogs($limit = 10) {
        $sql = "SELECT * FROM blog_data LIMIT = {$limit}";
        // Write some shit...
    }
}