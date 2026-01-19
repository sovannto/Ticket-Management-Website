<?php
include '../includes/db.php';
$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id");
$m = mysqli_fetch_assoc($res);
?>

<div class="animate-fadeIn">
    <div class="flex items-center gap-4 mb-8 text-white">
        <button onclick="loadSection('movies')" class="bg-white/5 p-3 rounded-xl hover:bg-white/10 transition">
            <i class="fa fa-arrow-left"></i>
        </button>
        <h2 class="text-2xl font-black uppercase italic border-l-4 border-blue-600 pl-4 text-white">Edit <span class="text-blue-600">Movie</span></h2>
    </div>

    <form id="updateMovieForm" method="POST" enctype="multipart/form-data" class="bg-[#111827] p-8 rounded-3xl border border-white/5 space-y-6 max-w-4xl mx-auto shadow-2xl">
        <input type="hidden" name="id" value="<?php echo $m['id']; ?>">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-gray-500 mb-2 uppercase tracking-widest">Movie Title</label>
                <input type="text" name="title" value="<?php echo $m['title']; ?>" required class="w-full bg-[#0B0F19] border border-white/10 p-4 rounded-2xl focus:border-blue-500 outline-none transition text-sm text-white">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-500 mb-2 uppercase tracking-widest">Price ($)</label>
                <input type="number" step="0.01" name="price" value="<?php echo $m['price']; ?>" required class="w-full bg-[#0B0F19] border border-white/10 p-4 rounded-2xl focus:border-blue-500 outline-none transition text-sm text-white">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-500 mb-2 uppercase tracking-widest">Category</label>
                <select name="category_id" required class="w-full bg-[#0B0F19] border border-white/10 p-4 rounded-2xl focus:border-red-500 outline-none transition text-sm text-white cursor-pointer">
                    <option value="" disabled selected>Select Movie Type</option>
                    <option value="1">Action</option>
                    <option value="2">Horror</option>
                    <option value="3">Romance</option>
                    <option value="4">Drama</option>
                    <option value="5">Last Update</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-500 mb-2 uppercase tracking-widest">New Poster (Leave blank if no change)</label>
                <input type="file" name="movie_image" accept="image/*" class="w-full bg-[#0B0F19] border border-white/10 p-4 rounded-2xl text-xs text-gray-400">
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2 text-white">
            <i class="fa fa-save text-lg"></i> Update Movie
        </button>
    </form>
</div>

<script>
// JavaScript សម្រាប់ Handle ការ Update
document.getElementById('updateMovieForm').onsubmit = function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('update_movie.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(result => {
        alert(result);
        if(result.includes("ជោគជ័យ")) {
            loadSection('movies'); // ត្រឡប់ទៅបញ្ជីរឿង
        }
    });
};
</script>