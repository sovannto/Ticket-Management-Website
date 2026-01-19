<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); } 
include 'db.php';

// កំណត់ User ID សម្រាប់ប្រើគ្រប់ទំព័រ
$auth_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />

    
    <style>
      body {
        background-color: #0b0f19;
        color: white;
        font-family: "Inter", sans-serif;
      }
    </style>
  </head>
  <body>
    <header
      class="flex justify-between items-center p-6 bg-[#111827] border-b border-white/5"
    >
      <a
        href="index.php"
        class="text-2xl font-black italic tracking-tighter text-[#F97316]"
        >Movie<span class="text-white" >Nest</span></a
      >

      <nav class="flex items-center gap-6 text-sm font-bold uppercase">
        <a href="index.php" class="hover:text-[#F97316]">Home</a>
        <a href="movies.php" class="hover:text-[#F97316]">Movies</a>

        <?php if(isset($_SESSION['user_id'])): ?>
        <a href="my-library.php">My Library</a>
        <a
          href="logout.php"
          class="bg-white/5 px-4 py-2 rounded-lg text-[#F97316]"
          >Logout</a
        >
        <?php else: ?>
        <a href="login.php" class="text-gray-400 hover:text-white">Login</a>
        <a
          href="register.php"
          class="bg-[#F97316] px-5 py-2 rounded-xl text-white shadow-lg shadow-red-600/20 hover:bg-orange-400 transition"
          >Register</a
        >
        <?php endif; ?>
      </nav>
    </header>

    <script>
      function handleAction(type, movie_id) {
        let formData = new FormData();
        formData.append("type", type);
        formData.append("movie_id", movie_id);

        fetch("../api/actions.php", { method: "POST", body: formData })
          .then((res) => res.text())
          .then((data) => {
            if (data === "login_required") {
              window.location.href = "../public/login.php";
            } else {
              location.reload();
            } // Update ប៊ូតុងភ្លាមៗ
          });
      }
    </script>
  </body>
</html>
