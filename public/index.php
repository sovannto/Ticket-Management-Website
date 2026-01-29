<?php 
include '../includes/db.php';
include '../includes/header.php';
$uid = $_SESSION['user_id'] ?? 0;
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="relative w-full h-[50vh] md:h-[70vh] mb-12">
    <div class="swiper heroSwiper h-full">
        <div class="swiper-wrapper">
            <div class="swiper-slide relative">
                <img src="https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?q=80&w=2070" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black via-black/40 to-transparent flex items-center px-12">
                    <div class="max-w-xl">
                        <span class="bg-[#FACC15] text-black px-3 py-1 rounded text-xs font-bold mb-4 inline-block">PREMIUM EXPERIENCE</span>
                        <h1 class="text-5xl font-black italic text-white mb-4">AVATAR: THE WAY OF WATER</h1>
                        <p class="text-gray-300 mb-6">Experience the breathtaking visuals on our Giant Screen. Tickets available now.</p>
                        <a href="#" class="bg-white text-black px-8 py-3 rounded-full font-bold hover:bg-[#FACC15] transition">BOOK NOW</a>
                    </div>
                </div>
            </div>
            
            <div class="swiper-slide relative">
                <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=1925" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black via-black/40 to-transparent flex items-center px-12">
                    <div class="max-w-xl">
                        <span class="bg-red-600 text-white px-3 py-1 rounded text-xs font-bold mb-4 inline-block">HOT PROMOTION</span>
                        <h1 class="text-5xl font-black italic text-white mb-4">COMBO POPCORN DEAL</h1>
                        <p class="text-gray-300 mb-6">Get 50% off on Large Popcorn every Wednesday at PRASAT Cinema.</p>
                        <a href="#" class="bg-[#FACC15] text-black px-8 py-3 rounded-full font-bold hover:bg-white transition">SEE DEALS</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next !text-[#FACC15]"></div>
        <div class="swiper-button-prev !text-[#FACC15]"></div>
    </div>
</section>

<div class="container mx-auto px-6 mb-20">
    <div class="flex items-center justify-between mb-8 border-l-4 border-[#FACC15] pl-4">
        <h2 class="text-2xl font-bold uppercase tracking-widest">Now Showing</h2>
        <a href="#" class="text-[#FACC15] text-sm font-bold hover:underline">View All</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
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
        <div class="group">
            <div class="relative aspect-[2/3] overflow-hidden rounded-2xl shadow-xl transition-all duration-500 group-hover:scale-[1.02] group-hover:shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
                <img src="../assets/posters/<?php echo $m['poster']; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-0 group-hover:opacity-100 flex flex-col justify-end p-5 transition-all duration-300">
                    <?php if($is_bought): ?>
                        <a href="watch.php?id=<?php echo $mid; ?>" class="bg-green-500 hover:bg-green-600 w-full py-3 rounded-xl text-center text-xs font-black transition-colors">WATCH NOW</a>
                    <?php else: ?>
                        <a href="detail.php?id=<?php echo $mid; ?>" class="bg-[#FACC15] hover:bg-white text-black w-full py-3 rounded-xl text-center text-xs font-black transition-colors shadow-lg shadow-[#FACC15]/20">BUY $<?php echo $m['price']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-4">
                <h3 class="text-sm font-bold text-white group-hover:text-[#FACC15] transition-colors truncate"><?php echo $m['title']; ?></h3>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-tighter mt-1">2D • Khmer Sub</p>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  const swiper = new Swiper('.heroSwiper', {
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    effect: 'fade', // Gives it a cinematic feel
    fadeEffect: {
      crossFade: true
    },
  });
</script>

<?php include '../includes/footer.php'; ?>