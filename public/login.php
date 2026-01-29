<!DOCTYPE html>
<html lang="en" class="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Prasat Cinema</title>
  <link rel="stylesheet" href="../assets/css/output.css  ">
</head>

<body class="bg-primary min-h-screen flex items-center justify-center p-4 font-primary">

  <div
    class="bg-dark-card w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-secondary/20">

    <div class="md:w-1/2 h-64 md:h-auto relative">
      <img src="./assets/images/seats.jpg" alt="Prasat Cinema" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-primary opacity-40"></div>
      <div class="absolute bottom-4 left-4">
        <h2 class="text-accent text-2xl font-bold tracking-wider">PRASAT CINEMA</h2>
        <p class="text-gray-300 text-sm">Welcome back.</p>
      </div>
    </div>

    <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Login</h1>
        <p class="text-secondary">Enter your details to access your tickets.</p>
      </div>

      <form action="login_process.php" method="POST" class="space-y-6">
        <div>
          <label class="block text-sm font-medium text-secondary mb-2">Email Address</label>
          <input type="email" name="email" required
            class="w-full px-4 py-3 rounded-lg bg-primary border border-secondary/50 text-gray-100 focus:ring-2 focus:ring-accent focus:outline-none">
        </div>

        <div>
          <label class="block text-sm font-medium text-secondary mb-2">Password</label>
          <input type="password" name="password" required
            class="w-full px-4 py-3 rounded-lg bg-primary border border-secondary/50 text-gray-100 focus:ring-2 focus:ring-accent focus:outline-none">
        </div>

        <button type="submit"
          class="w-full bg-accent hover:bg-[#e3b812] text-primary font-bold py-3 px-4 rounded-lg shadow-lg transition transform hover:scale-[1.02]">
          Login
        </button>
      </form>

      <p class="mt-8 text-center text-secondary text-sm">
        New to Prasat Cinema?
        <a href="register.php" class="text-accent hover:underline font-semibold">Create an account</a>
      </p>
    </div>
  </div>
</body>

</html>