<?php

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
    public function tableInit($table_blog_data, $table_user_data) {
        $result1 = $this->conn->query("SHOW TABLES LIKE '$table_user_data'");
        $result2 = $this->conn->query("SHOW TABLES LIKE '$table_blog_data'");
        if(mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0) {
            return false;
        }

        $statement_1 = "
            CREATE TABLE IF NOT EXISTS {$table_user_data} (
                user_id VARCHAR(16),
                email_address VARCHAR(128),
                password_hash VARCHAR(255),
                nickname VARCHAR(32),
                bio VARCHAR(255),
                create_date VARCHAR(32),
                last_login VARCHAR(32)
        )";

        $statement_2 = "
            CREATE TABLE IF NOT EXISTS {$table_blog_data} (
                blog_id VARCHAR(32),
                title VARCHAR(64),
                secondary_title VARCHAR(32),
                content VARCHAR(15000),
                author VARCHAR(16),
                FOREIGN KEY (author) REFERENCES {$table_user_data}(user_id),
                date_created VARCHAR(32),
                likes VARCHAR(32),
                dislikes VARCHAR(32),
                tags VARCHAR(32)
        )";


        $this->conn->query($statement_1) or die(mysqli_error($this->conn));
        $this->conn->query($statement_2) or die(mysqli_error($this->conn));

        return true;
    }


}