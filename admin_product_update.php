<?php
	require("connection.php");
    $idProduct = $_REQUEST['idProduct'];

    $resulting = mysqli_query($conn, "SELECT stok FROM products where id_products = '$idProduct'");
    $nambah = mysqli_fetch_row($resulting)[0] + 1;
    mysqli_query($conn, "UPDATE products set stok = '$nambah' where id_products = '$idProduct'");

?>