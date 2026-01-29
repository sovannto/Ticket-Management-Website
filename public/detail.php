<?php 
include '../includes/db.php';
include '../includes/header.php';

$mid = intval($_GET['id']);
$uid = $_SESSION['user_id'] ?? 0;
$movie = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM movies WHERE id = $mid"));

if (!$movie) { echo "<div class='text-center py-20'>Movie not found.</div>"; exit; }

$is_liked = false;
if($uid > 0) {
    $check_like = mysqli_query($conn, "SELECT id FROM likes WHERE user_id = $uid AND movie_id = $mid");
    if(mysqli_num_rows($check_like) > 0) $is_liked = true;
}
?>

<style>
    .seat { width: 30px; height: 30px; border-radius: 6px; cursor: pointer; transition: all 0.2s; }
    .seat-available { background: #1f2937; border: 1px solid #374151; }
    .seat-selected { background: #FACC15 !important; border-color: #FACC15; }
    .seat-occupied { background: #ef4444; cursor: not-allowed; opacity: 0.5; }
    .screen-glow { height: 5px; background: #FACC15; filter: blur(10px); width: 80%; margin: 0 auto; }
</style>

<div class="relative min-h-screen bg-[#08080a]">
    <div class="absolute inset-0 h-[50vh] opacity-20" style="background: url('../assets/posters/<?php echo $movie['poster']; ?>') center/cover;"></div>
    
    <div class="container mx-auto py-12 px-6 relative z-10">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="w-full lg:w-1/3">
                <div class="sticky top-24">
                    <img src="../assets/posters/<?php echo $movie['poster']; ?>" class="w-full rounded-2xl shadow-2xl border border-white/10">
                    <div class="mt-6 flex justify-between">
                        <button onclick="handleAction('like', <?php echo $mid; ?>)" class="flex-1 mr-2 flex items-center justify-center gap-2 p-3 bg-white/5 rounded-xl transition hover:bg-white/10 <?php echo $is_liked ? 'text-red-500' : 'text-white'; ?>">
                            <i class="fa-solid fa-heart"></i> Like
                        </button>
                        <button class="flex-1 ml-2 flex items-center justify-center gap-2 p-3 bg-white/5 rounded-xl transition hover:bg-white/10">
                            <i class="fa-solid fa-share-nodes"></i> Share
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3">
                <h1 class="text-6xl font-black italic tracking-tighter mb-2 text-white uppercase"><?php echo $movie['title']; ?></h1>
                <div class="flex gap-4 mb-6 text-sm font-bold text-[#FACC15]">
                    <span>2D / Digital</span> • <span>Khmer / English Sub</span> • <span>120 Mins</span>
                </div>
                <p class="text-gray-400 text-lg mb-10 leading-relaxed"><?php echo $movie['description']; ?></p>

                <div class="bg-[#111827] border border-white/5 rounded-3xl p-8 mb-8">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-[#FACC15]"></i> 1. Select Cinema & Time
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs text-gray-500 uppercase font-bold">Cinema Location</label>
                            <select id="location" class="w-full bg-white/5 border border-white/10 rounded-xl p-3 mt-2 focus:border-[#FACC15] outline-none">
                                <option>Prasat Cinema - Eden Garden</option>
                                <option>Prasat Cinema - AEON Mall 1</option>
                                <option>Prasat Cinema - Olympia Mall</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase font-bold">Showtime</label>
                            <div class="flex gap-3 mt-2">
                                <button class="px-4 py-2 bg-[#FACC15] text-black font-bold rounded-lg">10:30 AM</button>
                                <button class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:border-[#FACC15]">02:15 PM</button>
                                <button class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:border-[#FACC15]">07:00 PM</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#111827] border border-white/5 rounded-3xl p-8 mb-8">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-couch text-[#FACC15]"></i> 2. Choose Your Seats
                    </h3>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-full mb-12">
                            <div class="screen-glow mb-2"></div>
                            <p class="text-center text-[10px] text-gray-500 tracking-[0.5em] uppercase">Cinema Screen This Way</p>
                        </div>

                        <div class="grid grid-cols-8 gap-3 mb-8">
                            <?php for($i=1; $i<=32; $i++): ?>
                                <div class="seat seat-available" onclick="this.classList.toggle('seat-selected'); updateSummary();"></div>
                            <?php endfor; ?>
                        </div>

                        <div class="flex gap-6 text-[10px] font-bold uppercase text-gray-400">
                            <div class="flex items-center gap-2"><div class="seat seat-available w-4 h-4"></div> Available</div>
                            <div class="flex items-center gap-2"><div class="seat seat-selected w-4 h-4"></div> Selected</div>
                            <div class="flex items-center gap-2"><div class="seat seat-occupied w-4 h-4"></div> Occupied</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#FACC15] to-orange-500 p-8 rounded-3xl flex flex-col md:flex-row justify-between items-center text-black">
                    <div>
                        <p class="text-xs font-bold uppercase opacity-80">Total Payment</p>
                        <h2 class="text-4xl font-black" id="total-price">$0.00</h2>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="../api/process-buy.php?id=<?php echo $mid; ?>" class="bg-black text-white px-10 py-4 rounded-2xl font-black uppercase text-lg hover:scale-105 transition-transform inline-block">
                            Confirm Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSummary() {
        const selected = document.querySelectorAll('.seat-selected').length;
        const price = <?php echo $m['price'] ?? 5.50; ?>;
        document.getElementById('total-price').innerText = '$' + (selected * price).toFixed(2);
    }
</script>

<?php include '../includes/footer.php'; ?>