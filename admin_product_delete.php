<?php
	require("connection.php");
    $idProduct = $_REQUEST['idProduct'];

    $update_query = "UPDATE products SET status = 0 WHERE id_products='$idProduct'";
    $res = $conn->query($update_query);
?>