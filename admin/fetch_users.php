<?php 
include '../includes/db.php';

// In your new DB, the role is 'customer' and field is 'name'
$res = mysqli_query($conn, "SELECT * FROM users WHERE role = 'customer' ORDER BY id DESC");
?>

<div class="animate-fadeIn p-2">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-black uppercase tracking-tight border-l-4 border-[#FACC15] pl-4 text-white">
                CUSTOMER <span class="text-[#FACC15]">DATABASE</span>
            </h2>
            <p class="text-gray-500 text-[10px] uppercase tracking-[0.3em] mt-1">Prasat Membership Records</p>
        </div>
        <div class="bg-[#121212] border border-white/5 px-4 py-2 rounded-xl text-xs font-bold text-gray-400">
            Total Customers: <?php echo mysqli_num_rows($res); ?>
        </div>
    </div>

    <div class="bg-[#0a0a0a] rounded-2xl border border-white/5 overflow-hidden shadow-2xl">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/5 text-gray-400 text-[10px] uppercase tracking-widest">
                <tr>
                    <th class="p-6 border-b border-white/5">Member ID</th>
                    <th class="p-6 border-b border-white/5">Full Name</th>
                    <th class="p-6 border-b border-white/5">Email</th>
                    <th class="p-6 border-b border-white/5 text-center">Status</th>
                    <th class="p-6 border-b border-white/5 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(mysqli_num_rows($res) > 0): ?>
                    <?php while($u = mysqli_fetch_assoc($res)): ?>
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors group">
                        <td class="p-6 font-mono text-xs text-gray-500 group-hover:text-[#FACC15] transition-colors">
                            #LGD-<?php echo str_pad($u['id'], 4, '0', STR_PAD_LEFT); ?>
                        </td>
                        <td class="p-6 font-bold tracking-tight text-gray-200">
                            <?php echo htmlspecialchars($u['name']); ?>
                        </td>
                        <td class="p-6 text-gray-400">
                            <?php echo htmlspecialchars($u['email']); ?>
                        </td>
                        <td class="p-6 text-center">
                            <span class="bg-[#FACC15]/10 text-[#FACC15] px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border border-[#FACC15]/20">
                                <?php echo $u['role']; ?>
                            </span>
                        </td>
                        <td class="p-6 text-center">
                            <button onclick="loadSection('user_details&id=<?php echo $u['id']; ?>')" 
                                    class="bg-white/5 hover:bg-[#FACC15] hover:text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase transition-all duration-300 text-gray-400 border border-white/5">
                                View Profile
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="p-20 text-center text-gray-600 uppercase text-[10px] tracking-widest italic">
                            No customers found in system.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>