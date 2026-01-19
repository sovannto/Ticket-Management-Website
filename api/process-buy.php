<?php
session_start();
include '../includes/db.php';

// ១. ពិនិត្យមើលថាតើ User បាន Login និងមាន ID រឿងដែរឬទេ?
if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
    
    $user_id = intval($_SESSION['user_id']);
    $movie_id = intval($_GET['id']);

    // ២. ទាញយកតម្លៃរឿងពី Table movies ដើម្បីបញ្ជាក់តម្លៃដែលបានបង់ (Price Paid)
    $movie_query = mysqli_query($conn, "SELECT price FROM movies WHERE id = $movie_id");
    $movie_data = mysqli_fetch_assoc($movie_query);
    
    if (!$movie_data) {
        header("Location: ../public/index.php?error=movie_not_found");
        exit();
    }

    $price_paid = $movie_data['price'];

    // ៣. ពិនិត្យមើលការទិញស្ទួន (Prevention)
    $check = mysqli_query($conn, "SELECT id FROM purchases WHERE user_id = $user_id AND movie_id = $movie_id");

    if (mysqli_num_rows($check) == 0) {
        // ៤. បញ្ចូលទិន្នន័យការទិញ
        $sql = "INSERT INTO purchases (user_id, movie_id, price_paid) VALUES ($user_id, $movie_id, $price_paid)";
        
        if (mysqli_query($conn, $sql)) {
            // ជោគជ័យ៖ បញ្ជូនទៅកាន់ My Library
            header("Location: ../public/my-library.php?status=success");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // បើធ្លាប់ទិញហើយ៖ បញ្ជូនទៅកាន់ Library តែម្តង
        header("Location: ../public/my-library.php?status=already_owned");
        exit();
    }
} else {
    // បើមិនទាន់ Login៖ បញ្ជូនទៅទំព័រ Login
    header("Location: ../public/login.php");
    exit();
}
?>