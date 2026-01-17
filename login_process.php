<?php
session_start();
include 'includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify Password (Hash check)
        // Note: For the dummy accounts created via SQL (like admin), the password is '123456' (plain text).
        // For new users created via Register page, the password is HASHED.
        // This simple logic handles both for testing:
        
        if (password_verify($password, $row['password']) || $password === $row['password']) {
            
            // Set Session Variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['role'] = $row['role']; // 'admin' or 'customer'

            // Redirect based on Role
            if ($row['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();

        } else {
            echo "<script>alert('Invalid Password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.history.back();</script>";
    }
}
?>