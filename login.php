    <?php
    // Include user handling class and start session
    require_once('user.php'); 

    // Start session if it's not already active
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $error = ""; 
    ?>