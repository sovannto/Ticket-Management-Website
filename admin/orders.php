<?php 
include '../includes/db.php';
include '../includes/header.php';
?>

<div class="p-10">
    <h2 class="text-2xl font-black mb-8 italic uppercase text-red-600">Purchase Transactions</h2>
    
    <div class="bg-[#1F2937] rounded-3xl border border-white/5 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-black/30 text-xs text-gray-500 uppercase">
                <tr>
                    <th class="p-5">Order ID</th>
                    <th class="p-5">User</th>
                    <th class="p-5">Movie Title</th>
                    <th class="p-5">Price Paid</th>
                    <th class="p-5">Date</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-white/5">
                <?php 
                $sql = "SELECT purchases.*, users.username, movies.title 
                        FROM purchases 
                        JOIN users ON purchases.user_id = users.id 
                        JOIN movies ON purchases.movie_id = movies.id 
                        ORDER BY purchases.id DESC";
                $orders = mysqli_query($conn, $sql);
                while($o = mysqli_fetch_assoc($orders)): 
                ?>
                <tr class="hover:bg-white/[0.02] transition">
                    <td class="p-5 text-gray-500">#<?php echo $o['id']; ?></td>
                    <td class="p-5 font-bold text-orange-500"><?php echo $o['username']; ?></td>
                    <td class="p-5"><?php echo $o['title']; ?></td>
                    <td class="p-5 font-black text-green-500">$<?php echo number_format($o['price'], 2); ?></td>
                    <td class="p-5 text-gray-500"><?php echo $o['purchase_date'] ?? date("Y-m-d"); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>