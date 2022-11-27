<?php
    require("connection.php");
    $idProduct = $_REQUEST["idProduct"];
    $curQty = $_REQUEST["curQty"];

    mysqli_query($conn, "UPDATE carts SET qty = $curQty WHERE id_products = '$idProduct'");
?>