<?php 
include '../includes/db.php';
include '../includes/header.php';

$mid = intval($_GET['id']);
$uid = $_SESSION['user_id'] ?? 0;

$movie = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM movies WHERE id = $mid"));

// ឆែកមើលស្ថានភាព Like
$is_liked = false;
if($uid > 0) {
    $check_like = mysqli_query($conn, "SELECT id FROM likes WHERE user_id = $uid AND movie_id = $mid");
    if(mysqli_num_rows($check_like) > 0) $is_liked = true;
}
?>

<div class="container mx-auto py-20 px-6 flex flex-col md:flex-row gap-10">
    <div class="w-full md:w-1/3">
        <img src="../assets/posters/<?php echo $movie['poster']; ?>" class="w-full rounded-3xl shadow-2xl">
    </div>
    <div class="w-full md:w-2/3">
        <h1 class="text-5xl font-black mb-6 uppercase italic text-red-600"><?php echo $movie['title']; ?></h1>
        <p class="text-gray-400 text-lg mb-8 leading-relaxed"><?php echo $movie['description']; ?></p>
        
        <div class="flex items-center gap-6 mb-10">
            <button onclick="handleAction('like', <?php echo $mid; ?>)" class="flex items-center gap-2 p-3 bg-white/5 rounded-xl <?php echo $is_liked ? 'text-red-500' : 'text-white'; ?>">
                <i class="fa-solid fa-heart"></i> Like
            </button>
            <button onclick="handleAction('share', <?php echo $mid; ?>)" class="flex items-center gap-2 p-3 bg-white/5 rounded-xl hover:text-blue-400">
                <i class="fa-solid fa-share"></i> Share
            </button>
        </div>

        <a href="../api/process-buy.php?id=<?php echo $mid; ?>" class="bg-orange-600 px-10 py-4 rounded-2xl font-black uppercase text-xl shadow-lg shadow-orange-600/20">Buy Now - $<?php echo $movie['price']; ?></a>
    </div>
</div>