<?php 
include '../includes/db.php';
include '../includes/header.php';
$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
?>

<div class="container mx-auto p-10">
    <div class="flex gap-4 mb-10 overflow-x-auto pb-4">
        <a href="movies.php" class="px-6 py-2 bg-white/5 rounded-full text-sm font-bold hover:bg-[#F97316]">All Genres</a>
        <?php 
        $cats = mysqli_query($conn, "SELECT * FROM categories");
        while($c = mysqli_fetch_assoc($cats)) {
            echo "<a href='movies.php?cat={$c['id']}' class='px-6 py-2 bg-white/5 rounded-full text-sm font-bold hover:bg-[#F97316] whitespace-nowrap'>{$c['name']}</a>";
        }
        ?>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        <?php
        $sql = $cat_id > 0 ? "SELECT * FROM movies WHERE category_id = $cat_id" : "SELECT * FROM movies";
        $res = mysqli_query($conn, $sql);
        while($m = mysqli_fetch_assoc($res)) {
            // ... (ប្រើ Logic ប៊ូតុង Buy/Watch ដូចក្នុង index.php)
        }
        ?>
    </div>
</div>