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