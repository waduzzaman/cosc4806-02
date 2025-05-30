<?php
// Start session and include User class
session_start();
require_once('user.php');

// Initialize variables
$name = $username = $password = $confirm_password = "";
$errors = [];
?>