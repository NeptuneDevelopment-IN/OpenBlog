<?php

class Authenticator {

    public function __construct() {
        require_once (__DIR__."/../OpenBlog/Database.php");
        $this->db = new Database();
    }

    public function userExists($email_address): bool {
        $sql = "SELECT email_address FROM user_data WHERE email_address='{$email_address}'";
        $res = $this->db->conn->query($sql);
        if(mysqli_num_rows($res) > 0) {
            return true;
        }
        return false;
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyEmailPassword($email, $password): bool {
        $sql = "SELECT email_address, password_hash FROM user_data WHERE email_address={$email}";
        $res = $this->db->conn->query($sql);
        if(mysqli_num_rows($res) == 0) {
            return false;
        }
        $row = mysqli_fetch_array($res);
        $password_hash = $row['password_hash'];
        if(password_verify($password, $password_hash)) {
            return true;
        }
        return false;
    }

    public function changePassword($email, $old_password, $new_password) {
        $sql = "SELECT email_address, password_hash FROM user_data WHERE email_address={$email}";
        $res = $this->db->conn->query($sql);
        if(mysqli_num_rows($res) == 0) {
            return false;
        }
        $row = mysqli_fetch_array($res);
        $password_hash = $row['password_hash'];
        if(!password_verify($old_password, $password_hash)) {
            return false;
        }
        $new_pass_hash = $password_hash($new_password, PASSWORD_BCRYPT);
        $sql_2 = "UPDATE user_data SET password_hash={$new_pass_hash} WHERE email_address={$email}";
        $this->db->conn->query($sql_2);
        if(!mysqli_error($this->db->conn)) {
            return true;
        }
        return false;
    }

    public function generateUserID(): string
    {
        $user_id = $this->generateRandomID();
        // Check if the user ID already exists in the database
        while ($this->userIDExists($user_id)) {
            // If it exists, generate a new user ID and check again
            $user_id = $this->generateRandomID();
        }
        return $user_id;
    }

    public function generateRandomID(): string
    {
        $id = "";
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for ($i = 0; $i < 16; $i++) {
            $id .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $id;
    }

    public function userIDExists($user_id): bool
    {
        $qqq = $this->db->conn->query("SELECT user_id FROM user_data WHERE user_id='{$user_id}'");
        if (mysqli_num_rows($qqq) == 1) {
            return true;
        }
        return false;
    }

    public function createUser($email, $password, $nickname, $bio = "") {
        if($this->userExists($email)) {
            return false;
        }
        $unique_id = $this->generateUserID();
        $pass_hash = $this->hashPassword($password);
        $cur_date = time();
        $sql = "
            INSERT INTO user_data (
                user_id,
                email_address,
                password_hash,
                nickname,
                bio,
                create_date,
                last_login
            ) VALUES (
                '{$unique_id}',
                '{$email}',
                '{$pass_hash}',
                   '{$nickname}',
                '{$bio}',
                '{$cur_date}',
                '{$cur_date}'
            )
        ";
        $this->db->conn->query($sql);
        echo($this->db->conn->error);
    }

    public function deleteUser($email) {
        // I'll write it later...
    }




}