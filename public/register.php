<?php 
include '../includes/db.php';
include '../includes/header.php';
if(isset($_POST['reg'])) {
    $u = $_POST['user'];
    $e = $_POST['email'];
    $p = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (username, email, password, role) VALUES ('$u', '$e', '$p', 'user')");
    header("Location: login.php");
}
?>
<div class="max-w-sm mx-auto mt-20 bg-[#1F2937] p-8 rounded-3xl border border-white/5 text-center">
    <h2 class="text-2xl font-bold mb-6">REGISTER</h2>
    <form method="POST" class="space-y-4">
        <input type="text" name="user" placeholder="Username" class="w-full bg-gray-900 p-3 rounded-xl outline-none" required>
        <input type="email" name="email" placeholder="Email" class="w-full bg-gray-900 p-3 rounded-xl outline-none" required>
        <input type="password" name="pass" placeholder="Password" class="w-full bg-gray-900 p-3 rounded-xl outline-none" required>
        <button name="reg" class="w-full bg-orange-600 py-3 rounded-xl font-bold">Create Account</button>
    </form>
</div>