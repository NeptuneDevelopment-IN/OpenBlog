<?php
require_once ('ConfigManager.php');
class Database {

    public function __construct() {
        $this->config = new ConfigManager();
        $database_name = $this->config->getConfig()['database_name'];
        $database_host = $this->config->getConfig()['database_host'];
        $database_user = $this->config->getConfig()['database_user'];
        $database_pass = $this->config->getConfig()['database_pass'];
        $database_port = $this->config->getConfig()['database_port'];
        return $this->conn =  new mysqli($database_host, $database_user, $database_pass, $database_name, $database_port);
    }

    //Initalize and create all the tables in the database
    public function tableInit($table_blog_data, $table_user_data, $table_blog_categories) {
        $result1 = $this->conn->query("SHOW TABLES LIKE '$table_user_data'");
        $result2 = $this->conn->query("SHOW TABLES LIKE '$table_blog_data'");
        if(mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0) {
            return false;
        }

        $statement_1 = "
            CREATE TABLE IF NOT EXISTS {$table_user_data} (
                user_id VARCHAR(16) PRIMARY KEY,
                email_address VARCHAR(128) UNIQUE,
                password_hash VARCHAR(255),
                nickname VARCHAR(32),
                bio VARCHAR(255),
                create_date VARCHAR(32),
                last_login VARCHAR(32),
                is_admin TINYINT(1)
        )";

        $statement_3 = "
        CREATE TABLE IF NOT EXISTS {$table_blog_categories} (
            category_id int PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(32) UNIQUE,
            description VARCHAR(248)
        )
        ";
        $statement_2 = "
            CREATE TABLE IF NOT EXISTS {$table_blog_data} (
                id int PRIMARY KEY AUTO_INCREMENT,
                blog_id VARCHAR(32) UNIQUE,
                title VARCHAR(64),
                secondary_title VARCHAR(32),
                content VARCHAR(15000),
                author VARCHAR(16),
                FOREIGN KEY (author) REFERENCES {$table_user_data}(user_id),
                date_created VARCHAR(32),
                likes VARCHAR(32),
                dislikes VARCHAR(32),
                tags VARCHAR(32),
                category int,
                FOREIGN KEY(category) REFERENCES {$table_blog_categories} (category_id)
        )";


        $statement_4 = "
        INSERT INTO {$table_blog_categories} (name, description) VALUES ('Anime', 'For the anime fans the best and best blogs on anime')
        ";
        $statement_5 = "
        INSERT INTO {$table_blog_categories} (name, description) VALUES ('Gaming', 'For the gaming fans the best and best blogs on gaming')
        ";
        $statement_6 = "
        INSERT INTO {$table_blog_categories} (name, description) VALUES ('Traveling', 'For the traveling fans the best and best blogs on traveling')
        ";
        $statement_7 = "
        INSERT INTO {$table_blog_categories} (name, description) VALUES ('Random', 'Some random stuff')
        ";

        $this->conn->query($statement_1) or die(mysqli_error($this->conn));
        $this->conn->query($statement_3) or die(mysqli_error($this->conn));
        $this->conn->query($statement_2) or die(mysqli_error($this->conn));
        $this->conn->query($statement_4) or die(mysqli_error($this->conn));
        $this->conn->query($statement_5) or die(mysqli_error($this->conn));
        $this->conn->query($statement_6) or die(mysqli_error($this->conn));
        $this->conn->query($statement_7) or die(mysqli_error($this->conn));
        return true;
    }


}