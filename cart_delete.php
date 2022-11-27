<?php
    require("connection.php");
    $idProduct = $_REQUEST["idProduct"];

    mysqli_query($conn, "DELETE FROM carts WHERE id_products = '$idProduct'");
?>