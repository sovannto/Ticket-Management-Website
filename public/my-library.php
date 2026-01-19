<?php 
include '../includes/db.php';
include '../includes/header.php';

// បើមិនទាន់ Login ឱ្យទៅទំព័រ Login សិន
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$uid = $_SESSION['user_id'];
?>

<div class="container mx-auto px-6 py-10">
    <div class="mb-16">
        <h2 class="text-3xl font-black mb-8 italic uppercase border-l-4 border-red-600 pl-4">
            My <span class="text-red-600">Collection</span>
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            <?php
            $sql = "SELECT movies.* FROM movies 
                    JOIN purchases ON movies.id = purchases.movie_id 
                    WHERE purchases.user_id = $uid 
                    ORDER BY purchases.id DESC";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                while($m = mysqli_fetch_assoc($res)) {
            ?>
                <div class="bg-[#111827] p-2 rounded-3xl border border-white/5 group">
                    <div class="relative aspect-[2/3] rounded-2xl overflow-hidden">
                        <img src="../assets/posters/<?php echo $m['poster']; ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                            <a href="watch.php?id=<?php echo $m['id']; ?>" class="bg-green-500 px-6 py-2 rounded-xl font-bold text-[10px]">WATCH NOW</a>
                        </div>
                    </div>
                    <h3 class="text-white text-[11px] font-bold p-3 truncate"><?php echo $m['title']; ?></h3>
                </div>
            <?php 
                }
            } else {
                echo "<p class='col-span-full text-gray-500 py-10'>You haven't purchased any movies yet.</p>";
            }
            ?>
        </div>
    </div>

    <div>
        <h2 class="text-3xl font-black mb-8 italic uppercase border-l-4 border-blue-600 pl-4">
            Liked <span class="text-blue-600">Movies</span>
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            <?php
            $sql_liked = "SELECT movies.* FROM movies 
                          JOIN likes ON movies.id = likes.movie_id 
                          WHERE likes.user_id = $uid";
            $res_liked = mysqli_query($conn, $sql_liked);

            if (mysqli_num_rows($res_liked) > 0) {
                while($m = mysqli_fetch_assoc($res_liked)) {
            ?>
                <div class="bg-[#111827] p-2 rounded-3xl border border-white/5 opacity-70 hover:opacity-100 transition">
                    <img src="../assets/posters/<?php echo $m['poster']; ?>" class="rounded-2xl aspect-[2/3] object-cover mb-2">
                    <div class="p-2">
                        <h3 class="text-[10px] font-bold truncate mb-2"><?php echo $m['title']; ?></h3>
                        <a href="detail.php?id=<?php echo $m['id']; ?>" class="block text-center text-[9px] py-2 bg-white/5 rounded-lg hover:bg-blue-600 uppercase">View Details</a>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo "<p class='col-span-full text-gray-500 py-10 text-sm'>No liked movies yet.</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>