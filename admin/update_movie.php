<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get ID and Sanitize inputs
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $duration = intval($_POST['duration']); // New field
    $release_date = mysqli_real_escape_string($conn, $_POST['release_date']); // New field

    // 1. Check if a new poster is being uploaded
    if (!empty($_FILES['movie_image']['name'])) {
        $img_name = $_FILES['movie_image']['name'];
        $tmp_name = $_FILES['movie_image']['tmp_name'];
        
        // Use a clean naming convention for Prasat Cinema
        $extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $new_img_name = "Prasat_" . time() . "." . $extension;
        
        // Move to the correct folder (assets/)
        if (move_uploaded_file($tmp_name, "../assets/" . $new_img_name)) {
            // Update with NEW image
            $sql = "UPDATE movies SET 
                    title = '$title', 
                    duration = '$duration', 
                    release_date = '$release_date', 
                    poster = '$new_img_name' 
                    WHERE id = $id";
        }
    } else {
        // 2. Update only text fields (Keep existing poster)
        $sql = "UPDATE movies SET 
                title = '$title', 
                duration = '$duration', 
                release_date = '$release_date' 
                WHERE id = $id";
    }

    // Execute and return response for AJAX
    if (mysqli_query($conn, $sql)) {
        echo "Movie has been succesfully update!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>