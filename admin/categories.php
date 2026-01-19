<?php 
include '../includes/db.php';
include '../includes/header.php';

// មុខងារបន្ថែម Category
if(isset($_POST['add_cat'])){
    $name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    mysqli_query($conn, "INSERT INTO categories (name) VALUES ('$name')");
}
?>

<div class="flex min-h-screen">
    <main class="flex-1 p-10">
        <h2 class="text-2xl font-black mb-6">Manage Categories</h2>
        
        <form method="POST" class="mb-10 flex gap-4">
            <input type="text" name="cat_name" placeholder="Category Name" class="bg-gray-800 p-3 rounded-xl border border-white/10 w-64 outline-none focus:border-red-500" required>
            <button type="submit" name="add_cat" class="bg-red-600 px-6 py-3 rounded-xl font-bold hover:bg-red-700">Add</button>
        </form>

        <div class="bg-[#1F2937] rounded-2xl border border-white/5 overflow-hidden w-full max-w-xl">
            <table class="w-full text-left">
                <thead class="bg-black/20 text-xs text-gray-400 uppercase">
                    <tr><th class="p-4">ID</th><th class="p-4">Category Name</th><th class="p-4 text-center">Action</th></tr>
                </thead>
                <tbody class="text-sm divide-y divide-white/5">
                    <?php 
                    $cats = mysqli_query($conn, "SELECT * FROM categories");
                    while($c = mysqli_fetch_assoc($cats)): 
                    ?>
                    <tr>
                        <td class="p-4"><?php echo $c['id']; ?></td>
                        <td class="p-4 font-bold"><?php echo $c['name']; ?></td>
                        <td class="p-4 text-center">
                            <button class="text-red-400 hover:text-white"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>