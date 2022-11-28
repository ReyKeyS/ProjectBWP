<?php
    require("connection.php");
    $idUser = $_REQUEST["idUser"];
    $idProduct = $_REQUEST["idProduct"];

    mysqli_query($conn, "DELETE FROM carts WHERE id_products = '$idProduct'");

    $cekKosong = mysqli_query($conn, "SELECT count(*) from carts where id_users = '$idUser'");
    $kosongGa = mysqli_fetch_row($cekKosong)[0];
    echo $kosongGa;
    if(isset($_SESSION['tekoBuild'])){
        unset($_SESSION['tekoBuild']);
    }
?>