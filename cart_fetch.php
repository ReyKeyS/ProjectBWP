<?php
	require("connection.php");
    $idUser = $_REQUEST["idUser"];

    $queryCart = mysqli_query($conn, "SELECT * from carts where id_users = '$idUser'");
    
    $total = 0;
    $totalQty = 0;
?>
<div class="w-2/3 flex flex-col place-content-center">
    <div class="text-3xl font-semibold mx-auto">Your Cart</div>
    <div class="w-3/4 ml-auto">
    <?php
        while($row = mysqli_fetch_array($queryCart)){
            $queryProd = mysqli_query($conn, "SELECT * from products where id_products = '".$row["id_products"]."'");
            $isiProduct = mysqli_fetch_array($queryProd);

            $subtotal = $isiProduct["price"] * $row["qty"];
    ?>
        <div class="w-full my-3 border rounded-md shadow-lg overflow-hidden mb-10 flex">
            <img src="<?=$isiProduct["gmbr"]?>" alt="" class="w-72 h-11/12">
            <div class="flex flex-col my-auto">
                <div class="text-2xl font-semibold"><?=$isiProduct["nama"]?></div>
                <div><?=number_format($isiProduct["price"])?></div>
                <div><?=$row["qty"]?></div>
            </div>
            <div class="flex ml-auto my-auto mr-3">
                <div><?=number_format($subtotal)?></div>
                <button type="submit" name="delete" class="px-5 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">Delete</button>
            </div>
        </div>
    <?php
            $total += $subtotal;
            $totalQty += $row["qty"];
        }
    ?>
    </div>
</div>
<div class="w-1/3">
    <div class="w-1/3 px-5 py-3 flex border rounded-xl shadow-xl flex-col mx-auto mt-14">
        <div>Total:</div>
        <div>Rp <?=number_format($total)?></div>
        <div>Total QTY : <?=$totalQty?></div>
        <button type="submit" name="buy" class="px-3 py-1 font-semibold text-white my-2 ml-auto rounded-lg bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Buy</button>
    </div>
</div>
</html>