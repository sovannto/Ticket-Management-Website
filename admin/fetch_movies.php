<?php 
include '../includes/db.php';

// SQL updated for prasat_cinema database structure
// Using duration and release_date instead of category/price
$sql = "SELECT * FROM movies ORDER BY id DESC";
$res = mysqli_query($conn, $sql);
?>

<div class="animate-fadeIn text-white p-2">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <div>
            <h2 class="text-2xl font-black uppercase tracking-tight border-l-4 border-[#FACC15] pl-4">
                MOVIE <span class="text-[#FACC15]">LIBRARY</span>
            </h2>
            <p class="text-gray-500 text-[10px] uppercase tracking-[0.3em] mt-1">Manage Catalog & Content</p>
        </div>
        
        <button onclick="loadSection('add_movie')" class="group bg-[#FACC15] hover:bg-[#B59F3B] text-white px-6 py-3 rounded-xl flex items-center gap-3 transition-all duration-300 shadow-lg shadow-rose-600/20">
            <i class="fa fa-plus-circle text-lg group-hover:rotate-90 transition-transform duration-300"></i>
            <span class="text-xs font-black uppercase tracking-widest">Add New Movie</span>
        </button>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <?php if(mysqli_num_rows($res) > 0): ?>
            <?php while($m = mysqli_fetch_assoc($res)): ?>
            <div class="bg-[#0a0a0a] border border-white/5 rounded-[1.5rem] p-4 flex gap-6 hover:border-[#FACC15]/40 transition-all duration-500 group relative overflow-hidden">
                
                <div class="relative w-28 h-40 flex-shrink-0 overflow-hidden rounded-xl shadow-2xl">
                    <img src="../assets/<?php echo $m['poster']; ?>" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         onerror="this.src='https://via.placeholder.com/150x200?text=No+Poster'">
                    
                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black to-transparent p-2">
                        <span class="text-[9px] font-black text-white bg-[#FACC15] px-2 py-0.5 rounded">
                            <?php echo $m['duration']; ?> MIN
                        </span>
                    </div>
                </div>

                <div class="flex-1 flex flex-col justify-between py-1">
                    <div>
                        <div class="flex justify-between items-start">
                            <h4 class="text-lg font-bold text-gray-100 group-hover:text-[#FACC15] transition-colors truncate w-48">
                                <?php echo htmlspecialchars($m['title']); ?>
                            </h4>
                            <span class="text-[10px] font-mono text-gray-600">ID: #<?php echo $m['id']; ?></span>
                        </div>
                        
                        <div class="flex items-center gap-3 mt-2">
                            <span class="bg-white/5 text-gray-400 border border-white/10 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                <i class="fa fa-calendar-alt mr-1 text-[#FACC15]"></i> 
                                <?php echo date('Y', strtotime($m['release_date'])); ?>
                            </span>
                            
                            <span class="bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                <i class="fa fa-check-circle mr-1"></i> Active
                            </span>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-4">
                        <button onclick="loadSection('edit_movie&id=<?php echo $m['id']; ?>')" 
                                class="flex-1 bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 py-2.5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 text-[10px] font-black uppercase tracking-widest border border-white/5">
                            <i class="fa fa-edit text-[#FACC15]"></i> Edit
                        </button>

                        <button onclick="confirmDelete(<?php echo $m['id']; ?>)" 
                                class="flex-1 bg-white/5 text-gray-400 hover:text-white hover:bg-[#FACC15] py-2.5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 text-[10px] font-black uppercase tracking-widest border border-white/5">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-full bg-[#0a0a0a] border border-dashed border-white/10 rounded-[2rem] py-20 text-center">
                <i class="fa fa-film text-5xl text-gray-800 mb-4 block"></i>
                <p class="text-gray-500 font-bold uppercase tracking-[0.2em]">No movies found in Prasat database</p>
            </div>
        <?php endif; ?>
    </div>
</div>