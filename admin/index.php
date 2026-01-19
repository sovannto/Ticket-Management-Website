<?php 
include '../includes/db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="km">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Legend Cinema | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap");
      
      :root {
        --legend-red: #FACC15; /* Crimson Red */
        --legend-dark: #050505; /* Deep Black */
        --legend-gray: #121212; /* Sidebar Black */
        --legend-gold: #C5A059; /* Premium Gold */
      }

      body {
        font-family: "Inter", sans-serif;
        background-color: var(--legend-dark);
        color: white;
      }

      /* Legend Sidebar Styling */
      .sidebar-item.active {
        background: linear-gradient(90deg, var(--legend-red) 0%, #B59F3B 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(225, 29, 72, 0.4);
      }

      .sidebar-item:hover:not(.active) {
        background-color: rgba(255, 255, 255, 0.05);
        color: var(--legend-red);
      }

      /* Custom Scrollbar for Legend Look */
      ::-webkit-scrollbar { width: 6px; }
      ::-webkit-scrollbar-track { background: var(--legend-dark); }
      ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
      ::-webkit-scrollbar-thumb:hover { background: var(--legend-red); }

      /* Loading Animation */
      .loader {
        border-top-color: var(--legend-red);
      }
    </style>
  </head>
  <body class="flex h-screen overflow-hidden">
    
    <aside class="w-64 bg-[#0a0a0a] border-r border-white/5 flex flex-col p-6">
      <div class="flex flex-col items-center mb-10">
        <img class="w-24 h-24 object-contain" src="../assets/Logo.png" alt="Legend Cinema" />   
      </div>

      <nav class="flex-1 space-y-3">
        <button onclick="loadSection('stats', this)"
          class="sidebar-item active w-full flex items-center gap-4 px-4 py-3 rounded-lg text-sm font-semibold transition-all duration-200">
          <i class="fa fa-chart-line w-5"></i> Dashboard
        </button>

        <button onclick="loadSection('movies', this)"
          class="sidebar-item w-full flex items-center gap-4 px-4 py-3 rounded-lg text-sm font-semibold text-gray-400 transition-all duration-200">
          <i class="fa fa-film w-5"></i> Movies
        </button>

        <button onclick="loadSection('users', this)"
          class="sidebar-item w-full flex items-center gap-4 px-4 py-3 rounded-lg text-sm font-semibold text-gray-400 transition-all duration-200">
          <i class="fa fa-user-shield w-5"></i> Staff & Users
        </button>

        <button onclick="loadSection('orders', this)"
          class="sidebar-item w-full flex items-center gap-4 px-4 py-3 rounded-lg text-sm font-semibold text-gray-400 transition-all duration-200">
          <i class="fa fa-ticket-alt w-5"></i> Bookings
        </button>
      </nav>

      <div class="pt-6 border-t border-white/5">
        <a href="logout.php" class="flex items-center gap-4 px-4 py-3 text-sm font-semibold text-gray-500 hover:text-red-500 transition-colors">
          <i class="fa fa-sign-out-alt w-5"></i> Logout
        </a>
      </div>
    </aside>

    <main class="flex-1 flex flex-col bg-[#050505]">
      <header class="h-20 border-b border-white/5 flex items-center justify-between px-10 bg-[#0a0a0a]/80 backdrop-blur-md">
        <h2 id="page-title" class="text-xs font-bold uppercase tracking-widest text-gray-400">
          Legend / <span class="text-white">Dashboard</span>
        </h2>
        
        <div class="flex items-center gap-4">
            <span class="text-xs font-bold text-gray-400">Welcome, Srin</span>
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-red-600 to-rose-400 border-2 border-white/10 flex items-center justify-center font-bold text-white shadow-lg">
              A
            </div>
        </div>
      </header>

      <div id="main-content" class="flex-1 overflow-y-auto p-8">
        </div>
    </main>

    <script>
      // The logic remains the same, but we update the spinner color to Legend Red
      function loadSection(section, btn) {
        var container = document.getElementById("main-content");
        var title = document.getElementById("page-title");

        container.innerHTML = `
          <div class="flex flex-col justify-center items-center h-full space-y-4">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-rose-600"></div>
            <span class="text-xs text-gray-500 font-bold tracking-widest">LOADING LEGEND DATA</span>
          </div>`;

        var url = section.includes("&id=") ? "fetch_" + section.replace("&", ".php?") : "fetch_" + section + ".php";

        document.querySelectorAll(".sidebar-item").forEach(item => {
          item.classList.remove("active", "text-white");
          item.classList.add("text-gray-400");
        });
        if (btn) btn.classList.add("active", "text-white");

        var displayTitle = section.split("&")[0];
        title.innerHTML = `Legend / <span class="text-white">${displayTitle.toUpperCase()}</span>`;

        fetch(url)
          .then(res => { if (!res.ok) throw new Error("File not found: " + url); return res.text(); })
          .then(data => {
            container.innerHTML = data;
            if (section === "add_movie") initAddMovieForm();
            else if (section.includes("edit_movie")) initEditMovieForm();
          })
          .catch(err => {
            container.innerHTML = `<div class="bg-red-900/20 border border-red-500/50 text-red-500 rounded-xl p-6 text-center">Error: ${err.message}</div>`;
          });
      }

      // Rest of your JS functions (initAddMovieForm, initEditMovieForm, confirmDelete) go here...
      
      document.addEventListener("DOMContentLoaded", () => {
        loadSection("stats", document.querySelector(".sidebar-item"));
      });
    </script>
  </body>
</html>