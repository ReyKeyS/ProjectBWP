<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "db_proyek");

    if(mysqli_connect_errno()){
        echo mysqli_error($conn);
    }

    // if(isset($_SESSION["message"])){
    //     echo "<script>alert('$_SESSION[message]')</script>";
    //     unset($_SESSION["message"]);
    // }

?>