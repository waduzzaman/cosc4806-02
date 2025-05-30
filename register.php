<?php
// Start session and include User class
session_start();
require_once('user.php');

// Initialize variables
$name = $username = $password = $confirm_password = "";
$errors = [];

// Handle form submission and validate input

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate required fields
    if (empty($name) || empty($username) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    // Validate password strength
    if (!preg_match("/^[a-zA-Z0-9]{10,}$/", $password)) {
        $errors[] = "Password must be at least 10 alphanumeric characters.";
    }

    // Confirm password match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Check if username already exists
    $user = new User();
    if ($user->get_user_by_username($username)) {
        $errors[] = "Username already exists.";
    }

    // Register user if no errors
    if (empty($errors)) {
        if ($user->create_user($name, $username, $password)) {
            header("Location: login.php?registered=1");
            exit;
        } else {
            $errors[] = "Something went wrong while registering.";
        }
    }
}
?>