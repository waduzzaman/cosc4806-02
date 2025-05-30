    <?php
    // Include user handling class and start session
    require_once('user.php'); 

    // Start session if it's not already active
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $error = ""; 

// Handle login form submission and authentication

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $user = new User();
    $user_data = $user->get_user_by_username($username);

    if ($user_data && password_verify($password, $user_data['password'])) {
        session_regenerate_id(true); // 🛡️ Prevent session fixation
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect to protected page
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}


    ?>

    <!-- Display login form -->

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>

<?php
// Show registration success message
if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    echo "<p style='color:green;'>✅ Registration successful! Please log in.</p>";
}

// Show login error message
if ($error) {
    echo "<p style='color:red;'>❌ $error</p>";
}
?>

<!-- Login Form -->
<form method="POST" action="">
  <label>Username: <input type="text" name="username" required></label><br><br>
  <label>Password: <input type="password" name="password" required></label><br><br>
  <input type="submit" value="Login">
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
