<?php
session_start();
// Go up one level (..) to find includes
include '../includes/db_connection.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Securely check for admin role
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify Password
        if (password_verify($password, $row['password']) || $password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['role'] = 'admin';
            
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect Password";
        }
    } else {
        $error = "Access Denied. Admin privileges required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="dark">

<head>
  <meta charset="UTF-8">
  <title>Admin Login - Prasat Cinema</title>
  <link rel="stylesheet" href="../assets/output.css">
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen font-primary">

  <div class="bg-black p-8 rounded-xl shadow-2xl border border-gray-800 w-full max-w-md">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-white tracking-wider">ADMIN<span class="text-accent">PORTAL</span></h1>
      <p class="text-gray-500 text-sm mt-2">Restricted Access Only</p>
    </div>

    <?php if($error): ?>
    <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-2 rounded mb-4 text-center text-sm">
      <?php echo $error; ?>
    </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label class="block text-gray-400 text-sm mb-1">Email</label>
        <input type="email" name="email" required
          class="w-full bg-[#111] text-white px-4 py-3 rounded border border-gray-700 focus:border-accent focus:outline-none transition">
      </div>
      <div>
        <label class="block text-gray-400 text-sm mb-1">Password</label>
        <input type="password" name="password" required
          class="w-full bg-[#111] text-white px-4 py-3 rounded border border-gray-700 focus:border-accent focus:outline-none transition">
      </div>

      <button type="submit"
        class="w-full bg-accent hover:bg-yellow-400 text-black font-bold py-3 rounded shadow-lg transition transform active:scale-95">
        Access Dashboard
      </button>
    </form>

    <div class="mt-6 text-center">
      <a href="../index.php" class="text-gray-600 hover:text-white text-sm transition">← Return to Website</a>
    </div>
  </div>

</body>

</html>