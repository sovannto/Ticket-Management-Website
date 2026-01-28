<?php
include '../includes/db.php';

if (isset($_GET['query'])) {
    $search = mysqli_real_escape_string($conn, $_GET['query']);
    
    $sql = "SELECT * FROM movies WHERE title LIKE '%$search%' OR genre LIKE '%$search%' LIMIT 10";
    $result = mysqli_query($conn, $sql);
6
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <a href='detail.php?id={$row['id']}' class='flex items-center gap-4 p-3 hover:bg-white/5 border-b border-white/5 transition'>
                <img src='../assets/posters/{$row['poster_url']}' class='w-10 h-14 object-cover rounded-md'>
                <div>
                    <h4 class='text-sm font-bold text-white'>{$row['title']}</h4>
                    <p class='text-[10px] text-gray-400 font-bold'>\${$row['price']}</p>
                </div>
            </a>";
        }
    } else {
        echo "<p class='p-4 text-xs text-gray-500'>No movies found...</p>";
    }
}
?>