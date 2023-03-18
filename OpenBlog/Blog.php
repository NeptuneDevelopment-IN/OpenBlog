<?php 

class Blog {

    protected $db;
    
    //Connect to the database
    public function __construct() {
        $this->db = new mysqli("", "", "", "");
        if ($this->db->connect_error) {
            echo("Failed to connect to MySQL: " . $this->db->connect_error);
        }
    }
    
    // Get the blog by filtering it through the database and returning the data as an array.
    public function getBlog($id) {
        $data = $this->db->query("SELECT * FROM blog_data WHERE blog_id =". $id);
        if(mysqli_num_rows($data) > 0) {
            $row = mysqli_fetch_array($data);
            $blog = array(
                'title' => $row['title'],
                'content' => $row['blog_content'],
                'author' => $row['author'],
                'id' => $row['blog_id'],
                'date_created' => $row['date_created'],

            );
            return $blog;
        }
        return false;
    }    
}