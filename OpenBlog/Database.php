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
        $statement_1 = "
        CREATE TABLE IF NOT EXISTS {$table_blog_data} (
            blog_id VARCHAR(32),
            title VARCHAR(64),
            secondary_title(32),
            content VARCHAR(15000),
            author FOREIGN KEY (user_id) REFERENCES user_data(user_id),
            date_created VARCHAR(32),
            likes VARCHAR(32),
            dislikes VARCHAR(32),
            tags VARCHAR(32),      
        )
        ";
        $statement_2 = "";
    }

}