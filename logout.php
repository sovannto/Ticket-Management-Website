<?php
// Start the session to access current data
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie (optional but recommended for complete cleanup)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session storage
session_destroy();

// Redirect user back to Home Page
header("Location: index.php");
exit();
?>