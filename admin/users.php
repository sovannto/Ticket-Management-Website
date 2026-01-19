<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ចាប់យកទិន្នន័យ
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $price = $_POST['price'];

    // ឆែកមើលរូបភាព
    if (!isset($_FILES['movie_image']) || $_FILES['movie_image']['error'] !== UPLOAD_ERR_OK) {
        die("Error: រូបភាពមានបញ្ហា ឬមិនទាន់បានជ្រើសរើសរូបភាព!");
    }

    $img_name = $_FILES['movie_image']['name'];
    $tmp_name = $_FILES['movie_image']['tmp_name'];
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $new_img_name = "movie_" . time() . "." . $ext; 
    $target = "../assets/posters/" . $new_img_name;

    // បង្កើត Folder បើមិនទាន់មាន
    if (!is_dir('../assets/posters/')) {
        mkdir('../assets/posters/', 0777, true);
    }

    // ព្យាយាម Upload
    if (move_uploaded_file($tmp_name, $target)) {
        // បញ្ចូលទៅក្នុង Database
        $sql = "INSERT INTO movies (title, price, poster) VALUES ('$title', '$price', '$new_img_name')";
        
        if (mysqli_query($conn, $sql)) {
            echo "ជោគជ័យ: ទិន្នន័យត្រូវបានរក្សាទុក!";
        } else {
            // ប្រាប់ពីកំហុស SQL បើមាន (ឧទាហរណ៍៖ ឈ្មោះ Table ខុស)
            echo "SQL Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: មិនអាច Upload រូបភាពទៅកាន់ Folder បានទេ! សូមពិនិត្យ Permission លើ Folder assets/posters";
    }
}
?>