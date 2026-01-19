<?php 
include '../includes/db.php';

// Query all users from the prasat_cinema database
$sql = "SELECT * FROM users ORDER BY role ASC, name ASC";
$res = mysqli_query($conn, $sql);
?>

<div class="animate-fadeIn text-white p-2">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-black uppercase tracking-tight border-l-4 border-[#E11D48] pl-4">
                USER <span class="text-[#E11D48]">MANAGEMENT</span>
            </h2>
            <p class="text-gray-500 text-[10px] uppercase tracking-[0.3em] mt-1">Staff & Customer Directory</p>
        </div>
        <button onclick="loadSection('add_user')" class="bg-[#E11D48] hover:bg-[#be123c] text-white px-5 py-2.5 rounded-xl font-bold uppercase text-[10px] tracking-widest transition-all shadow-lg shadow-rose-600/20">
            + Add New User
        </button>
    </div>

    <div class="bg-[#0a0a0a] rounded-2xl border border-white/5 overflow-hidden shadow-2xl">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/5 text-gray-400 text-[10px] uppercase tracking-widest">
                <tr>
                    <th class="p-5 border-b border-white/5">User ID</th>
                    <th class="p-5 border-b border-white/5">Full Name</th>
                    <th class="p-5 border-b border-white/5">Email Address</th>
                    <th class="p-5 border-b border-white/5 text-center">Role</th>
                    <th class="p-5 border-b border-white/5 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(mysqli_num_rows($res) > 0): ?>
                    <?php while($u = mysqli_fetch_assoc($res)): ?>
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors group">
                        <td class="p-5 font-mono text-xs text-gray-500 group-hover:text-[#E11D48]">
                            #USR-<?php echo str_pad($u['id'], 3, '0', STR_PAD_LEFT); ?>
                        </td>
                        <td class="p-5 font-bold tracking-tight text-gray-200">
                            <?php echo htmlspecialchars($u['name']); ?>
                        </td>
                        <td class="p-5 text-gray-400">
                            <?php echo htmlspecialchars($u['email']); ?>
                        </td>
                        <td class="p-5 text-center">
                            <?php if($u['role'] == 'admin'): ?>
                                <span class="bg-[#E11D48] text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    Admin
                                </span>
                            <?php else: ?>
                                <span class="bg-white/10 text-gray-400 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border border-white/5">
                                    Customer
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="p-5 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="loadSection('edit_user&id=<?php echo $u['id']; ?>')" class="p-2 bg-white/5 text-gray-400 rounded-lg hover:bg-white/10 hover:text-white transition-all">
                                    <i class="fa fa-edit text-xs"></i>
                                </button>
                                <button onclick="confirmDeleteUser(<?php echo $u['id']; ?>)" class="p-2 bg-rose-600/10 text-[#E11D48] rounded-lg hover:bg-[#E11D48] hover:text-white transition-all">
                                    <i class="fa fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="p-20 text-center text-gray-600 uppercase text-[10px] tracking-widest">
                            No users registered.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>