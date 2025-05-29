<?php
//  Load database config and initialize session
require_once('database.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    // Define the User class
    class User {
        
        // Add method to retrieve all users
        public function get_all_users() {
            $db = db_connect();
            $stmt = $db->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Add method to get a user by username
        public function get_user_by_username($username) {
            $db = db_connect();
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Add method to create new user with hashed password
        public function create_user($name, $username, $password) {
            $db = db_connect();
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);             // Securely hash password
            $stmt = $db->prepare("INSERT INTO users (name, username, password) VALUES (:name, :username, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password);
            return $stmt->execute();
        }

        
      
    }
?>
