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

    public function createUser($email, $password, $nickname, $bio = "", $is_admin) {
        if($this->userExists($email)) {
            return false;
        }

        $is_admin = intval($is_admin);

        $email = mysqli_real_escape_string($this->db->conn, $email);
        $nickname = mysqli_real_escape_string($this->db->conn, $nickname);
        $bio = mysqli_real_escape_string($this->db->conn, $bio);

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
                last_login,
                is_admin
                                   
            ) VALUES (
                '{$unique_id}',
                '{$email}',
                '{$pass_hash}',
                '{$nickname}',
                '{$bio}',
                '{$cur_date}',
                '{$cur_date}',
                '{$is_admin}'
            )
        ";
        $this->db->conn->query($sql);
    }

    public function loginUser($email): bool {
        $sql = "SELECT * FROM user_data WHERE email_address='${email}'";
        $res = $this->db->conn->query($sql);
        if(mysqli_num_rows($res) == 0) {
            return false;
        }
        $res = mysqli_fetch_array($res);
        if(session_status() == 'PHP_SESSION_NONE ') {
            session_start();
        }
        $_SESSION['is_logged_in'] = true;
        $_SESSION['is_admin'] = $res['is_admin'];
        $_SESSION['nickname'] = $res['nickname'];
        $_SESSION['user_id'] = $res['user_id'];
        $_SESSION['bio'] = $res['bio'];
        $_SESSION['create_date'] = $res['create_date'];
        $_SESSION['last_login'] = $res['last_login'];
        $_SESSION['email_address'] = $res['email_address'];
        echo(mysqli_error($this->db->conn));
        return true;
    }

    public function deleteUser($email) {
        // I'll write it later...
    }

    public function isLoggedIn():bool {
        if( isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
            return true;
        }
        return false;
    }
    public function getUser($id) {
        $sql = "SELECT * FROM user_data WHERE user_id='{$id}'";
        $res = $this->db->conn->query($sql);
        $row = mysqli_fetch_array($res);
        $data = array(
            'is_admin' => $row['is_admin'],
            'nickname' => $row['nickname'],
            'email_address' => $row['email_address'],
            'bio' => $row['bio'],
            'create_date' => $row['create_date'],
            'last_login' => $row['last_login'],
        );
        return $data;
    }
    public function passwordHash($email) {
        $email = mysqli_real_escape_string($this->db->conn, $email);
        $sql = "SELECT email_address,password_hash FROM user_data WHERE email_address='{$email}'";
        $res = $this->db->conn->query($sql);
        $row = mysqli_fetch_array($res);
        if($res) {
            return $row['password_hash'];
        }
        return false;
    }

    //Update a user's profile info
    public function updateUser($email, $nickname, $bio) {
        $sql = "UPDATE user_data SET email_address='{$email}', nickname='{$nickname}', bio='{$bio}'";
        $res = $this->db->conn->query($sql);
        if($res) {
            return true;
        }
        return false;
    }



}