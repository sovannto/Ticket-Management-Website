<?php
include '../includes/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $price = $_POST['price'];
    $video_link = mysqli_real_escape_string($conn, $_POST['video_link']);
    $category_id = $_POST['category_id'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $img_name = $_FILES['movie_image']['name'];
    $tmp_name = $_FILES['movie_image']['tmp_name'];
    $new_img_name = "poster_" . time() . "_" . str_replace(' ', '_', $img_name);
    $target = "../assets/posters/" . $new_img_name;

    if (!is_dir("../assets/posters/")) { mkdir("../assets/posters/", 0777, true); }

    if (move_uploaded_file($tmp_name, $target)) {
        $sql = "INSERT INTO movies (title, price, poster, video_link, category_id, description) VALUES ('$title', '$price', '$new_img_name', '$video_link', '$category_id', '$description')";
        if (mysqli_query($conn, $sql)) { echo "ជោគជ័យ: ទិន្នន័យត្រូវបានរក្សាទុក!"; }
        else { echo "SQL Error: " . mysqli_error($conn); }
    } else { echo "Error: Upload រូបភាពមិនបានសម្រេច!"; }
}
?>