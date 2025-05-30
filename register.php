<?php
// Start the session
session_start();  
require_once('user.php');

// Initialize variables
$name = $username = $password = $confirm_password = "";
$errors = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate required fields
    if (empty($name) || empty($username) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    // Validate password format
    if (!preg_match("/^[a-zA-Z0-9]{10,}$/", $password)) {
        $errors[] = "Password must be at least 10 alphanumeric characters.";
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    $user = new User();
    // Check if username already exists
    if ($user->get_user_by_username($username)) {
        $errors[] = "Username already exists.";
    }

    // If no errors, create user
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

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h2>Register</h2>
<?php
    // Display error messages if any
foreach ($errors as $error) {
    echo "<p style='color:red;'>❌ $error</p>";
}
?>
    <!-- // Registration form -->
<form method="POST" action="">
  <label>Name: <input type="text" name="name" required></label><br><br>
  <label>Username: <input type="text" name="username" required></label><br><br>
  <label>Password: <input type="password" name="password" required></label><br><br>
  <label>Confirm Password: <input type="password" name="confirm_password" required></label><br><br>
  <input type="submit" value="Register">
</form>
    <!-- // Link to login page -->
<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
