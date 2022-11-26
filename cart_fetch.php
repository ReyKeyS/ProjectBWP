<?php
	require("connection.php");
    $idUser = $_REQUEST["idUser"];

    $queryCart = mysqli_query($conn, "SELECT * from carts where id_users = '$idUser'");
    $cekisi=mysqli_query($conn,"SELECT * from carts where id_users = '$idUser'");
    $hasilisi=mysqli_fetch_array($cekisi);
    $total = 0;
    $totalQty = 0;
    if(isset($hasilisi)){
?>
<div class="w-2/3 flex flex-col place-content-center">
    <div class="text-6xl font-semibold mx-auto flex">
        <!-- <img src="assets/shopping-cart-icon.png" alt="" class="w-20 h-20 mr-3">     -->
        <a class="my-auto">Your Cart</a>
    </div>
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
                <div class="text-4xl font-semibold mb-7"><?=$isiProduct["nama"]?></div>
                <div class="text-2xl font-medium">Price : <?=number_format($isiProduct["price"])?></div>
                <div>Amount : <?=$row["qty"]?></div>
            </div>
            <div class="flex flex-col ml-auto my-auto mr-3">
                <button type="submit" name="delete" class="px-5 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">Cancel</button>
                <div class="text-2xl font-medium">Subtotal : <?=number_format($subtotal)?></div>
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
    <div class="w-1/2 px-5 py-3 flex flex-col border rounded-xl shadow-xl mx-auto mt-14">
        <div class="text-lg">
            <input type="checkbox" name="build" disabled>
            Build Service : Rp 120.000
        </div>
        <div class="text-xl font-medium">Grand Total:</div>
        <!-- JOK LUPA DITAMBAHI SAMA SERVICE E -->
        <div class="text-2xl font-medium ml-auto">Rp <?=number_format($total)?></div>
        <button type="submit" name="buy" class="px-3 py-1 font-semibold text-white my-2 ml-auto rounded-lg bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Buy</button>
    </div>
    <?php
    }
    else{
    ?>
    <div class="w-1/2 bg-green-300 flex flex-col mx-auto font-mono mt-auto">
        <div class="mx-auto text-9xl font-semibold">ERROR 404</div>
        <div class="mx-auto text-6xl">Your cart is empty</div>
        <div class="mx-auto text-3xl">Lets go shopping</div>
        <div class="mx-auto">
            <button type="submit" formaction="index.php" class="px-5 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Go Shopping</button>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</html>