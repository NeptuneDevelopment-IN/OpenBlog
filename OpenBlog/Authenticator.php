<?php

class Authenticator {

    public function __construct() {
        $this->config = new ConfigManager();
        $database_name = $this->config->getConfig()['database_name'];
        $database_host = $this->config->getConfig()['database_host'];
        $database_user = $this->config->getConfig()['database_user'];
        $database_pass = $this->config->getConfig()['database_pass'];
        $database_port = $this->config->getConfig()['database_port'];
        $this->conn = new mysqli($database_host, $database_user, $database_pass, $database_name, $database_port);
    }

    public function userExists($user_id) {
        $sql = "SELECT user_id FROM user_data WHERE user_id={$user_id}";
        $res = $this->conn->query($sql);
        if(mysqli_num_rows($res) > 0) {
            return true;
        }
        return false;
    }

}