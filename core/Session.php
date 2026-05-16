<?php
/* This class is responsible for:
    starting sessions
    storing logged-in user data
    checking if user is logged in
    logout users */

    class Session {
  
    public static function check($role) {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != $role) {
            header("Location: /MySESS_Senior_Project/public/login");  //kick
            exit;
        }
    }
}
?>