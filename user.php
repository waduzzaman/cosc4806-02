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

        
      
    }
?>
