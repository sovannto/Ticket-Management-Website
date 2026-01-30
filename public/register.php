<!DOCTYPE html>
<html lang="en" class="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Prasat Cinema</title>
  <link rel="stylesheet" href="../assets/css/output.css">
</head>

<body class="bg-primary min-h-screen flex items-center justify-center p-4 font-primary">

  <div
    class="bg-dark-card w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-secondary/20">

    <div class="md:w-1/2 h-64 md:h-auto relative">
      <img src="./assets/images/seats.jpg" alt="Prasat Cinema Hall" class="w-full h-full object-cover object-center">
      <div class="absolute inset-0 bg-primary opacity-30"></div>
      <div class="absolute bottom-4 left-4">
        <h2 class="text-accent text-2xl font-bold tracking-wider">PRASAT CINEMA</h2>
        <p class="text-gray-300 text-sm">Experience the magic.</p>
      </div>
    </div>

    <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
      <div class="mb-8 text-center md:text-left">
        <h1 class="text-3xl font-bold text-white mb-2">Create Account</h1>
        <p class="text-secondary">Join us to book your favorite seats.</p>
      </div>

      <form action="register_process.php" method="POST" class="space-y-6">

        <div>
          <label for="name" class="block text-sm font-medium text-secondary mb-2">Full Name</label>
          <input type="text" id="name" name="name" required placeholder="e.g., Srin Naravuoch"
            class="w-full px-4 py-3 rounded-lg bg-primary border border-secondary/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition duration-200">
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-secondary mb-2">Email Address</label>
          <input type="email" id="email" name="email" required placeholder="you@example.com"
            class="w-full px-4 py-3 rounded-lg bg-primary border border-secondary/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition duration-200">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-secondary mb-2">Password</label>
          <input type="password" id="password" name="password" required placeholder="••••••••"
            class="w-full px-4 py-3 rounded-lg bg-primary border border-secondary/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition duration-200">
        </div>
        <div>
          <label for="confirm_password" class="block text-sm font-medium text-secondary mb-2">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" required placeholder="••••••••"
            class="w-full px-4 py-3 rounded-lg bg-primary border border-secondary/50 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition duration-200">
        </div>

        <button type="submit"
          class="w-full bg-accent hover:bg-[#e3b812] text-primary font-bold py-3 px-4 rounded-lg shadow-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-accent focus:ring-opacity-50">
          Create Account
        </button>
      </form>

      <p class="mt-8 text-center text-secondary text-sm">
        Already have an account?
        <a href="login.php" class="text-accent hover:underline font-semibold">Login here</a>
      </p>
    </div>
  </div>

</body>

</html>