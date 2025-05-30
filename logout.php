<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();  
}
// delete  all session variables
session_unset();    
// Destroy the session completely
session_destroy();  
// Redirect to login page
header("Location: login.php"); 
exit;
