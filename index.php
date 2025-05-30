<?php
if (session_status() == PHP_SESSION_NONE) {
    // Start session if not already started
    session_start();  
}

// Redirect the user to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Welcome</title></head>
<body>
 <!--  Display welcome message with user's username -->
<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<p>You have successfully logged in.</p>
<a href="logout.php">Logout</a>
</body>
</html>
