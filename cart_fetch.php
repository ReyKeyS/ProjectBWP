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
<div class="w-full sm:w-2/3 flex flex-col">
    <div class="text-2xl sm:text-6xl font-semibold mx-auto flex">
        <!-- <img src="assets/shopping-cart-icon.png" alt="" class="w-20 h-20 mr-3">     -->
        <a class="my-auto">Your Cart</a>
    </div>
    <div class="w-full sm:w-3/4 ml-auto">
    <?php
        while($row = mysqli_fetch_array($queryCart)){
            $queryProd = mysqli_query($conn, "SELECT * from products where id_products = '".$row["id_products"]."'");
            $isiProduct = mysqli_fetch_array($queryProd);

            $subtotal = $isiProduct["price"] * $row["qty"];
    ?>
        <div class="w-full my-3 border rounded-md shadow-lg overflow-hidden mb-10 flex">
            <div class="w-1/4 mx-3">
                <img src="<?=$isiProduct["gmbr"]?>" alt="" class="w-72 h-11/12">
            </div>
            <div class="w-2/4 flex flex-col my-auto">
                <div class="text-xl sm:text-4xl font-semibold mb-7"><?=$isiProduct["nama"]?></div>
                <div class="text-base sm:text-2xl font-medium">Price : <?=number_format($isiProduct["price"])?></div>
                <div>
                    <b>Amount :</b>
                    <!-- Amount : <button class="border-2 border-black rounded">➖</button> <?=$row["qty"]?> <button class="border-2 border-black rounded">➕</button> -->
                    <input type="number" onchange="update_cart(this)" min="1" max="<?=$isiProduct["stok"]?>" value='<?=$row["qty"]?>' class="border border-slate-500 rounded-lg w-14 h-7" idProduct='<?=$row["id_products"]?>'>
                </div>
            </div>
            <div class="w-1/4 flex flex-col ml-auto my-auto mr-3">
                <div class="text-sm sm:text-base">Stock : <?=$isiProduct["stok"]?></div>
                <button type="button" onclick="delete_cart(this)" value="<?=$row["id_products"]?>" class="px-1 py-1 sm:px-5 sm:py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">Cancel</button>
                <div class="text-base sm:text-2xl font-medium">Subtotal : <?=number_format($subtotal)?></div>
            </div>
        </div>
    <?php
            $total += $subtotal;
            $totalQty += $row["qty"];
        }
    
    
    ?>
    </div>
    <div class="w-1/2 px-5 py-3 flex flex-col sm:hidden border rounded-xl shadow-xl mx-auto mt-14">
        <div class="text-sm sm:text-lg">
            <input type="checkbox" disabled <?php if(isset($_SESSION["tekoBuild"])) echo "checked";?>>
            Build Service :<br> Rp 120.000
        </div>
        <div class="text-lg sm:text-xl font-medium">Grand Total:</div>
        <!-- JOK LUPA DITAMBAHI COST BUILD SERVICE E -->
        <div class="text-lg sm:text-2xl font-medium ml-auto">Rp <?=number_format($total)?></div>
        <?php $_SESSION["grandtotal"] = $total ?>
        <button type="submit" name="buy" class="px-3 py-1 font-semibold text-white my-2 ml-auto rounded-lg bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Buy</button>
    </div>
    <div class="w-full px-5 py-3 flex flex-col sm:hidden mx-auto mt-14 text-xs text-red-500 font-bold">
        *Add and remove items via the build page to get your pc built
        <br>
        *Any other actions may cause your pc not to be build
    </div>
</div>
<div class="w-0 sm:w-1/3 hidden sm:block">
    <div class="w-1/2 px-5 py-3 flex flex-col border rounded-xl shadow-xl mx-auto mt-14">
        <div class="text-lg">
            <input type="checkbox" disabled <?php if(isset($_SESSION["tekoBuild"])) echo "checked";?>>
            Build Service : Rp 120.000
        </div>
        <div class="text-xl font-medium">Grand Total:</div>
        <!-- JOK LUPA DITAMBAHI COST BUILD SERVICE E -->
        <div class="text-2xl font-medium ml-auto">Rp <?=number_format($total)?></div>
        <?php $_SESSION["grandtotal"] = $total ?>
        <button type="submit" name="buy" class="px-3 py-1 font-semibold text-white my-2 ml-auto rounded-lg bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Buy</button>
    </div>
    <div class="w-1/2 px-5 py-3 flex flex-col mx-auto mt-14 text-xs text-red-500 font-bold">
        *Add and remove items via the build page to get your pc built
        <br><br>
        *Any other actions may cause your pc not to be build
    </div>
    <?php
    }
    else{
    ?>
    <!-- <form action="" method="POST">
        <div class="w-1/2 flex flex-col mx-auto font-mono mt-auto">
            <div class="mx-auto text-9xl font-semibold"><marquee>ERROR 404</marquee></div>
            <div class="text-9xl text-center">☠</div>
            <div class="mx-auto text-6xl">Your cart is empty</div>
            <div class="mx-auto text-3xl">Lets go shopping</div>
            <div class="mx-auto mt-10">
                <button type="submit" formaction="index.php" class="px-5 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Go Shopping</button>
            </div>
        </div>
    </form> -->
    <?php
    }
    ?>
</div>
</html>