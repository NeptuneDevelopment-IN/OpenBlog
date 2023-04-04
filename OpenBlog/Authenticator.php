<?php

class Authenticator {

    public function __construct() {
        $this->db = new Database();
    }

    public function userExists($email_address): bool {
        $sql = "SELECT email_address FROM user_data WHERE email_address={$user_id}";
        $res = $this->db->conn->query($sql);
        if(mysqli_num_rows($res) > 0) {
            return true;
        }
        return false;
    }

    public function hashPassword($password) {
        return password_hash($password, 'PASSWORD_BCRYPT');
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
        $new_pass_hash = $password_hash($new_password, 'PASSWORD_BCRYPT');
        $sql_2 = "UPDATE user_data SET password_hash={$new_pass_hash} WHERE email_address={$email}";
        $this->db->conn->query($sql_2);
        if(!mysqli_error($this->db->conn)) {
            return true;
        }
        return false;
    }
    public function createUser($email, $password, $name) {
        //To be continued later
    }




}