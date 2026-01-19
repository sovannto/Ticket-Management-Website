<?php
include '../includes/db.php';
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $res = mysqli_query($conn, "SELECT poster FROM movies WHERE id = '$id'");
    $row = mysqli_fetch_assoc($res);
    if ($row) { @unlink("../assets/posters/" . $row['poster']); }
    
    if (mysqli_query($conn, "DELETE FROM movies WHERE id = '$id'")) { echo "ជោគជ័យ: រឿងត្រូវបានលុប!"; }
    else { echo "Error: " . mysqli_error($conn); }
}
?>