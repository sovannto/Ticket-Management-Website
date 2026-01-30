<?php
// DYNAMIC PATH HANDLING
// Detect if we are in a subfolder (like /admin/) and adjust paths to go back to root.
// If the script path contains '/admin', set base to '../', otherwise './'
$base = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) ? '../' : './';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="fixed top-0 left-0 w-full z-50 bg-primary/10 backdrop-blur-md border-b border-white/10 transition-all">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">

      <div class="hidden md:flex flex-1 items-center">
        <div class="relative w-full max-w-xs">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </span>
          <input type="text"
            class="block w-full pl-10 pr-3 py-2 border border-secondary/30 rounded-full leading-5 bg-black/20 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-black/40 focus:border-accent focus:ring-1 focus:ring-accent sm:text-sm transition duration-200"
            placeholder="Search movies...">
        </div>
      </div>

      <div class="flex-shrink-0 flex items-center justify-center flex-1">
        <a href="<?php echo $base; ?>index.php">
          <img class="h-20 w-auto object-contain hover:scale-105 transition-transform duration-300"
            src="<?php echo $base; ?>assets/images/prasat-cinema-logo.png" alt="Prasat Cinema">
        </a>
      </div>

      <div class="hidden md:flex flex-1 items-center justify-end space-x-6">

        <a href="<?php echo $base; ?>booking.php"
          class="group flex items-center text-gray-300 hover:text-accent transition">
          <svg class="h-6 w-6 mr-1 group-hover:animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
          </svg>
          <span class="font-medium text-sm">Tickets</span>
        </a>

        <button class="text-gray-300 hover:text-accent transition relative">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
          <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-600 ring-2 ring-primary"></span>
        </button>

        <?php if(isset($_SESSION['user_id'])): ?>

        <div class="relative group">
          <button class="flex items-center space-x-2 text-secondary hover:text-accent focus:outline-none">
            <div
              class="h-9 w-9 rounded-full bg-secondary/20 flex items-center justify-center border border-secondary text-accent font-bold">
              <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
            </div>
          </button>
          <div
            class="absolute right-0 mt-2 w-48 bg-[#141414] border border-white/10 rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
            <div class="px-4 py-2 border-b border-white/10">
              <p class="text-sm text-white font-semibold"><?php echo $_SESSION['user_name']; ?></p>
              <p class="text-xs text-gray-400">Customer</p>
            </div>
            <a href="<?php echo $base; ?>logout.php" class="block px-4 py-2 text-sm text-red-400 hover:bg-white/5">Sign
              out</a>
          </div>
        </div>

        <?php else: ?>

        <a href="<?php echo $base; ?>register.php"
          class="bg-accent hover:bg-yellow-400 text-primary font-bold py-2 px-6 rounded-full shadow-lg transition transform hover:scale-105 text-sm">
          Join Now
        </a>

        <?php endif; ?>
      </div>

      <div class="-mr-2 flex md:hidden">
        <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
          class="text-gray-400 hover:text-white p-2">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="hidden md:hidden bg-primary/95 border-t border-white/10" id="mobile-menu">
    <div class="px-4 pt-2 pb-4 space-y-1">
      <a href="<?php echo $base; ?>booking.php" class="block py-2 text-gray-300">Tickets</a>
      <?php if(isset($_SESSION['user_id'])): ?>
      <a href="<?php echo $base; ?>logout.php" class="block py-2 text-red-400">Sign Out</a>
      <?php else: ?>
      <a href="<?php echo $base; ?>register.php" class="block py-2 text-accent">Join Now</a>
      <?php endif; ?>
    </div>
  </div>
</nav>