<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Protect Customer Pages (like booking.php)
function requireLogin() {
    if (!isLoggedIn()) {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit();
    }
}

// Protect Admin Pages (like dashboard.php)
function requireAdmin() {
    // Check if logged in AND role is admin
    if (!isLoggedIn() || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        // Redirect to Admin Login, not User Login
        header("Location: ../admin/login.php"); 
        exit();
    }
}
?>