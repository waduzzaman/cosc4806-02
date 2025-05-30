<?php
require_once('user.php');

if (session_status() == PHP_SESSION_NONE) {
    // Start session if not started yet
    session_start();  
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $user = new User();
    $user_data = $user->get_user_by_username($username);

    // Verify user and password
    if ($user_data && password_verify($password, $user_data['password'])) {
        session_regenerate_id(true); 
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<?php
    // Display registration success message if registered
if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    echo "<p style='color:green;'>✅ Registration successful! Please log in.</p>";
}
    // Display error message if login failed
if ($error) {
    echo "<p style='color:red;'>❌ $error</p>";
}
?>
    <!-- // Login form  -->
<form method="POST" action="">
  <label>Username: <input type="text" name="username" required></label><br><br>
  <label>Password: <input type="password" name="password" required></label><br><br>
  <input type="submit" value="Login">
</form>
    <!-- // Link to register page -->
<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
