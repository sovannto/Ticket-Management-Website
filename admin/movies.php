<?php 
include '../includes/db.php';
// Note: We remove header.php if this is loaded into the Dashboard via AJAX to avoid nested <html> tags.
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-black tracking-tight text-white">
                MOVIE <span class="text-[#E11D48]">LIBRARY</span>
            </h2>
            <p class="text-gray-500 text-xs mt-1 uppercase tracking-[0.2em]">Legend Cinema Management</p>
        </div>
        <button onclick="loadSection('add_movie', this)" 
                class="bg-[#E11D48] hover:bg-[#be123c] text-white px-6 py-3 rounded-xl font-bold uppercase text-xs tracking-widest transition-all duration-300 shadow-lg shadow-rose-600/20">
            <i class="fa fa-plus mr-2"></i> Add New Movie
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php 
        // Query updated for prasat_cinema structure
        $query = "SELECT * FROM movies ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0):
            while($m = mysqli_fetch_assoc($result)): 
        ?>
        <div class="bg-[#121212] rounded-2xl border border-white/5 overflow-hidden group hover:border-[#E11D48]/50 transition-all duration-500 shadow-2xl">
            <div class="relative aspect-[2/3] overflow-hidden">
                <img src="../assets/<?php echo $m['poster']; ?>" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     alt="<?php echo htmlspecialchars($m['title']); ?>">
                
                <div class="absolute top-4 left-4 bg-black/70 backdrop-blur-md text-[#E11D48] text-[10px] font-black px-3 py-1 rounded-full border border-white/10">
                    <?php echo $m['duration']; ?> MINS
                </div>
            </div>

            <div class="p-5">
                <h3 class="font-bold text-lg text-white truncate mb-1">
                    <?php echo htmlspecialchars($m['title']); ?>
                </h3>
                <p class="text-gray-500 text-xs mb-4">
                    Released: <?php echo date('d M, Y', strtotime($m['release_date'])); ?>
                </p>

                <div class="flex justify-between items-center pt-4 border-t border-white/5">
                    <span class="text-[10px] text-gray-600 font-bold uppercase tracking-widest">ID #<?php echo $m['id']; ?></span>
                    <div class="flex gap-2">
                        <button onclick="loadSection('edit_movie&id=<?php echo $m['id']; ?>')" 
                                class="p-2.5 bg-white/5 text-gray-400 rounded-lg hover:bg-white/10 hover:text-white transition-all">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button onclick="confirmDelete(<?php echo $m['id']; ?>)" 
                                class="p-2.5 bg-rose-600/10 text-[#E11D48] rounded-lg hover:bg-[#E11D48] hover:text-white transition-all">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            endwhile; 
        else:
        ?>
            <div class="col-span-full py-20 flex flex-col items-center opacity-20">
                <i class="fa fa-film text-6xl mb-4"></i>
                <p class="text-xl font-bold">No movies found in database</p>
            </div>
        <?php endif; ?>
    </div>
</div>