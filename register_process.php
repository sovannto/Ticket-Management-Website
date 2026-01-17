<?php
session_start();
include 'includes/db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Confirm password is match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    // Check if Email already exists
    $checkEmail = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered! Please login.'); window.location.href='login.php';</script>";
        exit();
    }

    // Hash the password
    // We never store plain text passwords like '123456'. We store a hash.
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert User into Database
    // Default role is 'customer'
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'customer')";

    if ($conn->query($sql) === TRUE) {
        // Success! Redirect to login page
        echo "<script>alert('Registration Successful! Please Login.'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>