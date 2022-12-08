<?php
	require("connection.php");
    $search = $_REQUEST["search"];
    $sorted = $_REQUEST["sorted"];
    $minimum = $_REQUEST["minimum"];
    $maximum = $_REQUEST["maximum"];
    $cate = $_REQUEST["cate"];
    $page = ($_REQUEST["page"]-1)*12;

    if ($cate != ""){
        if ($minimum != 0 || $maximum != 0){
            $queryProducts = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted LIMIT 12 OFFSET $page");
            $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted");
        }else{
            $queryProducts = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' ORDER BY nama $sorted LIMIT 12 OFFSET $page");
            $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' ORDER BY nama $sorted");
        }
    }else{
        if ($minimum != 0 || $maximum != 0){
            $queryProducts = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted LIMIT 12 OFFSET $page");
            $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted");
        }else{
            $queryProducts = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' ORDER BY nama $sorted LIMIT 12 OFFSET $page");
            $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' ORDER BY nama $sorted");
        }
    }

    $bnykProduct = intval($queryProducts->num_rows);
    $bnykPage = intval($queryPage->num_rows)/12;
?>
<div class="mx-auto w-2/3 sm:-mt-[60px]">
    <ul class="flex justify-center">
        <li class="">
            <button class="border border-neutral-700 rounded-l-lg sm:py-1 sm:px-3 p-1 sm:text-base text-sm hover:bg-neutral-400 hover:text-white" onclick="prev_btn()">Previous</button>
        </li>
    <?php
        for ($i=0; $i < $bnykPage; $i++) { 
    ?>
        <li class="">
            <button class="border border-neutral-700 sm:py-1 sm:px-3 p-1 sm:text-base text-sm
            <?php 
                if($_REQUEST["page"] == $i+1){
                    echo 'bg-neutral-700 text-white font-semibold';
                }
                else{
                    echo 'hover:bg-neutral-400 hover:text-white';
                }
            ?>" onclick="paging(<?=$i+1?>)"><?=$i+1?></button>
        </li>
    <?php
        }
    ?>
        <li class="">
            <button class="border border-neutral-700 rounded-r-lg sm:py-1 sm:px-3 p-1 sm:text-base text-sm hover:bg-neutral-400 hover:text-white" onclick="next_btn()">Next</button>
        </li>
    </ul>
</div>
<form action="#" method="POST">
    <div class="grid sm:grid-cols-4 grid-cols-2 sm:gap-y-16 gap-y-8 mx-auto my-8">
        <?php
            for ($i=0; $i < $bnykProduct; $i++) { 
                $row = mysqli_fetch_array($queryProducts);
        ?>
            <button data-aos="fade-down" class="sm:w-96 w-40 h-full shadow-lg overflow-hidden mx-auto rounded-lg p-5" formaction="detail_product.php?ID=<?=$row["id_products"]?>";>
                <img src='<?=$row["gmbr"]?>' alt="" class="w-full h-11/12">
                <hr class="mt-3">
                <div class="sm:px-6 sm:py-3 px-2 py-1">
                    <div class="font-bold sm:text-xl text-lg mb-2 text-slate-700"><?=$row["nama"]?></div>
                    <p class="sm:text-xl text-sm text-slate-700">Rp <?=number_format((int)$row["price"])?></p>
                    <!-- <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-700 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Add to Cart</button> -->
                </div>
            </button>
        <?php
            }
        ?>
    </div>
</form>
<div class="mx-auto w-2/3 mb-8">
    <ul class="flex justify-center">
        <li class="">
            <button class="border border-neutral-700 rounded-l-lg sm:py-1 sm:px-3 p-1 sm:text-base text-sm hover:bg-neutral-400 hover:text-white" onclick="prev_btn()">Previous</button>
        </li>
    <?php
        for ($i=0; $i < $bnykPage; $i++) { 
    ?>
        <li class="">
            <button class="border border-neutral-700 sm:py-1 sm:px-3 p-1 sm:text-base text-sm 
            <?php 
                if($_REQUEST["page"] == $i+1){
                    echo 'bg-neutral-700 text-white font-semibold';
                }
                else{
                    echo 'hover:bg-neutral-400 hover:text-white';
                }
            ?>" onclick="paging(<?=$i+1?>)"><?=$i+1?></button>
        </li>
    <?php
        }
    ?>
        <li class="">
            <button class="border border-neutral-700 rounded-r-lg sm:py-1 sm:px-3 p-1 sm:text-base text-sm hover:bg-neutral-400 hover:text-white" onclick="next_btn()">Next</button>
        </li>
    </ul>
</div>
</html>