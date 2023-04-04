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

}