<?php
	require("connection.php");
    $search = $_REQUEST["search"];

	$queryProducts = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%'");
    $bnykData = intval($queryProducts->num_rows);
?>
<?php
    for ($i=0; $i < $bnykData; $i++) { 
        $row = mysqli_fetch_array($queryProducts);
?>
    <button class="w-96 h-full shadow-lg overflow-hidden mx-auto rounded-lg p-5" formaction="detail_product.php?ID='<?=$row["id_products"]?>'";>
        <img src='<?=$row["gmbr"]?>' alt="" class="w-full h-11/12">
        <hr class="mt-3">
        <div class="px-6 py-3">
            <div class="font-bold text-xl mb-2 text-slate-700"><?=$row["nama"]?></div>
            <p class="text-xl text-slate-600">Rp <?=number_format((int)$row["price"])?></p>
            <!-- <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Add to Cart</button> -->
        </div>
    </button>
<?php
        
    }
?>
</html>