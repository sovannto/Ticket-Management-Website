<?php 
include '../includes/db.php';
include '../includes/header.php';
$uid = $_SESSION['user_id'] ?? 0;
?>
<div class="container mx-auto p-6 grid grid-cols-2 md:grid-cols-5 gap-6">

    <!-- Movies Categories  ID  -->
    <?php
    $res = mysqli_query($conn, "SELECT * FROM movies ORDER BY id DESC");
    while($m = mysqli_fetch_assoc($res)) {
        $mid = $m['id'];
        $is_bought = false;
        if($uid > 0) {
            $check = mysqli_query($conn, "SELECT id FROM purchases WHERE user_id = $uid AND movie_id = $mid");
            if(mysqli_num_rows($check) > 0) $is_bought = true;
        }
    ?>
    <!-- End  -->

    <div class="bg-[#111827] p-2 rounded-2xl border border-white/5 group ">
        <div class="relative aspect-[2/3] overflow-hidden rounded-xl">
            <img src="../assets/posters/<?php echo $m['poster']; ?>" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center p-4 transition">
                <?php if($is_bought): ?>
                    <a href="watch.php?id=<?php echo $mid; ?>" class="bg-green-500 w-full py-2 rounded-lg text-center text-[10px] font-bold">WATCH NOW</a>
                <?php else: ?>
                    <a href="detail.php?id=<?php echo $mid; ?>" class="bg-orange-500 w-full py-2 rounded-lg text-center text-[10px] font-bold">BUY $<?php echo $m['price']; ?></a>
                <?php endif; ?>
            </div>
        </div>
        <h3 class="text-xs font-bold p-2 truncate"><?php echo $m['title']; ?></h3>
    </div>
    <?php } ?>
</div>
<?php include '../includes/footer.php'; ?>