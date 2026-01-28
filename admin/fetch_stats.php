<?php 
include '../includes/db.php';


$total_movies = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM movies"))['t'] ?? 0;
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM users WHERE role = 'user'"))['t'] ?? 0;
// $res_o = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t, SUM(price_paid) as r FROM purchases"));
$total_orders = $res_o['t'] ?? 0;
$total_revenue = $res_o['r'] ?? 0;
?>

<div class="animate-fadeIn">
    <h2 class="text-2xl font-black mb-8 italic uppercase border-l-4 border-[#FACC15] pl-4 text-white">System <span class="text-[#FACC15]">Overview</span></h2>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div  onclick="loadSection('movies', this)" class="bg-[#111827] p-6 rounded-3xl border border-white/5 relative overflow-hidden cursor-pointer">
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest">Total Movies</p>
            <h2 class="text-3xl font-black mt-2"><?php echo $total_movies; ?></h2>
            <i class="fa fa-film absolute -right-2 -bottom-2 text-5xl text-white/5"></i>
        </div>

        <div  onclick="loadSection('users', this)" class="bg-[#111827] p-6 rounded-3xl border border-white/5 relative overflow-hidden cursor-pointer">
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest">Active Users</p>
            <h2 class="text-3xl font-black mt-2 text-blue-500"><?php echo $total_users; ?></h2>
            <i class="fa fa-users absolute -right-2 -bottom-2 text-5xl text-white/5"></i>
        </div>

        <div class="bg-[#111827] p-6 rounded-3xl border border-white/5 relative overflow-hidden cursor-pointer">
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest">Revenue</p>
            <h2 class="text-3xl font-black mt-2 text-green-500">$<?php echo number_format($total_revenue, 2); ?></h2>
            <i class="fa fa-dollar-sign absolute -right-2 -bottom-2 text-5xl text-white/5"></i>
        </div>

        <div  onclick="loadSection('orders', this)" class="bg-[#111827] p-6 rounded-3xl border border-white/5 relative overflow-hidden cursor-pointer">
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest">Sales Count</p>
            <h2 class="text-3xl font-black mt-2 text-orange-500"><?php echo $total_orders; ?></h2>
            <i class="fa fa-shopping-cart absolute -right-2 -bottom-2 text-5xl text-white/5"></i>
        </div>
    </div>
</div>