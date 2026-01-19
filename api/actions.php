<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "login_required";
    exit();
}

$uid = $_SESSION['user_id'];
$mid = $_POST['movie_id'];
$type = $_POST['type'];

if ($type == 'like') {
    $check = mysqli_query($conn, "SELECT id FROM likes WHERE user_id = $uid AND movie_id = $mid");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "DELETE FROM likes WHERE user_id = $uid AND movie_id = $mid");
        echo "unliked";
    } else {
        mysqli_query($conn, "INSERT INTO likes (user_id, movie_id) VALUES ($uid, $mid)");
        echo "liked";
    }
}
?>