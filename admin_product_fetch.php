<?php
	require("connection.php");

	$queryProducts = mysqli_query($conn, "SELECT p.id_products, p.nama, p.price, c.nama, p.stok from products p JOIN categories c ON c.id_cate = p.id_cate where status = 1 ORDER BY p.id_products");
	
?>
<table>
    <tr>
        <th class="">No</th>
        <th class="">ID</th>
        <th class="">Name</th>
        <th class="">Price</th>
        <th class="">Category</th>
        <th class="">Amount</th>
        <th class="">Action</th>
    </tr>
    <?php
        if($queryProducts->num_rows == 0){
    ?>
        <tr>
            <td colspan="7" class="text-center">Product is Empty</td> 
        </tr>
    <?php
        }else{
            $ctr = 1;
            while($row = mysqli_fetch_row($queryProducts)){
    ?>
        <tr>
            <td class="text-right"><?= $ctr++?></td>
            <td class=""><?= $row[0]?></td>
            <td class=""><?=$row[1]?></td>
            <td class="">Rp <?=number_format($row[2])?></td>
            <td class=""><?=$row[3]?></td>
            <td class="text-center"><?=$row[4]?></td>
            <td class="">
                <button class="px-3 py-2 rounded bg-green-500 hover:bg-green-600" onclick="update_stock(this)" value="<?= $row[0]?>">Add Amount</button>
                <button class="px-3 py-2 rounded bg-red-500 hover:bg-red-600" onclick="delete_product(this)" value="<?= $row[0]?>">Delete</button>    
            </td>
        </tr>
    <?php
            }
        }
    ?>
</table>
</html>