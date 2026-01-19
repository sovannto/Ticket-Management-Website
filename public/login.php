<?php 
include '../includes/db.php';
include '../includes/header.php';
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
    if($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: " . ($user['role'] == 'admin' ? '../admin/index.php' : 'index.php'));
    }
}
?>
<div class="max-w-sm mx-auto mt-20 bg-[#1F2937] p-8 rounded-3xl border border-white/5">
    <h2 class="text-2xl font-bold mb-6 text-center">LOGIN</h2>
    <form method="POST" class="space-y-4">
        <input type="email" name="email" placeholder="Email" class="w-full bg-gray-900 p-3 rounded-xl outline-none" required>
        <input type="password" name="password" placeholder="Password" class="w-full bg-gray-900 p-3 rounded-xl outline-none" required>
        <button name="login" class="w-full bg-red-600 py-3 rounded-xl font-bold">Sign In</button>
    </form>
</div>