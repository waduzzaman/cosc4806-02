<?php
require_once('database.php');
// Start session if not started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();  
}

class User {
    // Retrieve all users from database
    public function get_all_users() {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve a single user by username
    public function get_user_by_username($username) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new user with hashed password
    public function create_user($name, $username, $password) {
        $db = db_connect();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (name, username, password) VALUES  (:name, :username, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        return $stmt->execute();
    }
}
?>
