<?php
    require_once("connection.php");
    $logged = false;
    if (isset($_SESSION['data'])){
        $logged = true;
    }
    if (isset($_POST["logout"])){
        unset($_SESSION['data']);
        header("Location: index.php");
    }
    if(isset($_POST['cart'])){
        ceklogin('cart');
    }
    if(isset($_POST['build'])){
        ceklogin('build');
    }
    if(isset($_POST['history'])){
        ceklogin('history');
    }
    function ceklogin($pergi){
        if(isset($_SESSION['data'])){
            header("Location:$pergi.php");
        }
        else{
            echo "<script>alert('Please Login first')</script>";
            header("Location: login.php");
        }
    }

    $idHtrans = "";
    if (isset($_GET["hID"])){
        $idHtrans = $_GET["hID"];

        $queryHTRANS = mysqli_query($conn, "SELECT * from htrans where id_htrans = '$idHtrans'");
        $dataHTRANS = mysqli_fetch_array($queryHTRANS);

        $queryDTRANS = mysqli_query($conn, "SELECT p.gmbr, p.nama, dt.qty, p.price from dtrans dt JOIN products p ON p.id_products = dt.id_products where id_htrans = '$idHtrans'");
    }

    if (isset($_POST["cancelTrans"])){
        mysqli_query($conn, "UPDATE htrans SET status = 2 where id_htrans = '".$dataHTRANS["id_htrans"]."'");
        header("Location: history.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaction</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="" method="POST">
        <div class="min-h-screen flex flex-col">
        <nav class="h-20 bg-gradient-to-r from-slate-700 via-slate-500 to-slate-300 flex fixed w-full z-10">
            <a class="w-28 my-auto ml-3" href="index.php">
                <img src="assets/Logo.jpg" alt="" class="w-12 h-12 mx-auto rounded-full">
            </a>
            <a class="my-auto w-64 text-white font-bold text-2xl" href="index.php">
            <?php
                    // if(isset($_SESSION['data'])){
                    //     echo $_SESSION['data']['nama'];
                    // }
                    // else{
                    //     echo "Glorindo Komputer";
                    // }
                ?> 
                Glorindo Komputer
            </a>
            <div class="my-auto w-1/2 flex">
                <input type="text" name="search" placeholder="Cari Disini" class="px-5 py-2 rounded-l-xl w-full focus:ring-4 focus:ring-purple-400 focus:outline-none cursor-not-allowed" disabled>
                <button name="btnsearch" class="border-l-2 bg-white rounded-r-xl w-12 pl-1 hover:bg-slate-400 disabled:opacity-25 cursor-not-allowed disabled:hover:bg-white" disabled>
                    <img src="assets/search.png" alt="" class="w-8 h-8 p-1">
                </button>
            </div>
            <div class="w-24 my-auto">
                <button type="submit" name="build" class="px-5 py-2 flex mx-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Build</button>
            </div>
            <div class="w-32 my-auto">
                <button type="submit" name="cart" class="flex w-24 px-2 m-auto rounded-2xl bg-slate-600 font-semibold text-white hover:bg-slate-900">
                    <img src="assets/shopping-cart.png" alt="" class="w-10 h-10 p-1">
                    <span class="my-auto p-1">Cart</span>
                </button>
            </div>
            <?php
            if($logged){
            ?>
                <div class="w-32 my-auto flex flex-col">
                    <a class="my-auto text-center font-bold text-lg">
                        <img src="assets/gonadi.jpg" alt="" class="w-7 h-7 mx-auto rounded-full">
                        <div>
                            <?= $_SESSION['data']['nama']?>
                        </div>
                    </a>
                </div>
                <div class="w-28 my-auto">
                    <button type="submit" name="history" class="px-5 py-2 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">History</button> 
                </div>
                <div class="w-24 my-auto">  
                    <button type="submit" name="logout" class="px-5 py-2 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Logout</button>
                </div>
            <?php
                }else{
            ?>
                <div class="w-32 my-auto">
                    <button type="submit" formaction="login.php" class="px-5 py-2 mx-3 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Login</button>
                </div>
                <div class="w-32 my-auto">
                    <button type="submit" formaction="register.php" class="px-5 py-2 m-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Register</button>
                </div>
            <?php
                }
            ?>
        </nav>
        <div class="pt-20 w-11/12 mx-auto flex flex-col">
            <div class="flex justify-center">
                <!-- <button type="submit" formaction="history.php" class="px-5 py-3 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Back</button> -->
                <div class="text-4xl font-bold bg-gradient-to-r from-purple-700 to-blue-600 bg-clip-text text-transparent">TRANSACTION DETAIL</div>
            </div>
            <div class="w-1/2 p-5 mx-auto my-4 flex flex-col border rounded-xl shadow-xl">
                <div class="text-xl flex w-full"><a class="text-slate-400"><?=$dataHTRANS["invoice"]?></a><a class="ml-auto"><?=substr($dataHTRANS["tanggal"], 0, 10)?> | <?=substr($dataHTRANS["tanggal"], 11)?></a></div>
                <div class="text-2xl font-semibold">Product Details</div>
                <?php
                    $totalSubtotal = 0;
                    while($row = mysqli_fetch_row($queryDTRANS)){
                ?>  
                <div class="flex border rounded-xl my-2 mx-10 shadow-sm">
                    <div class="w-1/4">
                        <img src="<?=$row[0]?>" alt="" class="w-24 h-24 mx-auto">
                    </div>
                    <div class="w-2/4 flex flex-col">
                        <div class="text-3xl font-semibold"><?=$row[1]?></div>
                        <div class="text-base text-slate-600"><?=$row[2]?> x Rp <?=number_format($row[3])?></div>
                    </div>
                    <div class="w-1/4 flex flex-col">
                        <div class="text-lg">Subtotal</div>
                        <div class="text-2xl font-bold">Rp <?=number_format($row[2]*$row[3])?></div>
                    </div>
                </div>
                <?php
                        $totalSubtotal += ($row[2]*$row[3]);
                    }
                ?>
                <div class="text-lg">Total Price : Rp <?=number_format($totalSubtotal)?></div>
                <div class="text-lg">Build Service : Rp <?php if ($dataHTRANS["dirakit"] == 0) echo "0"; else echo "120,000"; ?></div>
                <div class="font-bold text-2xl">Grand Total : Rp <?=number_format($dataHTRANS["total"])?></div>
                <div class="flex ml-auto">
                    <?php
                        if($dataHTRANS["status"]=="1"){
                    ?>
                        <button type="submit" name="cancelTrans" class="px-3 py-2 w-20 rounded-xl mr-3 text-white font-semibold bg-red-500 hover:bg-red-600">Cancel</button>
                    <?php
                        }
                    ?>
                    <a href="history.php" class="font-bold mb-2 my-auto bg-gradient-to-r from-purple-700 to-blue-600 bg-clip-text text-transparent hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800 hover:bg-clip-text hover:text-transparent hover:cursor-pointer">Back to History</a>
                </div>
            </div>
        </div>
        <nav class="h-96 bg-black mt-auto">
            <div class="flex">
                <div class="w-1/2 pt-5 flex flex-col border-r">
                    <div class="flex justify-center my-1">
                        <div class="text-white mr-5 text-4xl font-semibold">Send Us Mail</div>
                        <img src="assets/email (1).png" alt="">
                    </div>
                    <input type="text" name="email" placeholder="Email Address" class="px-3 py-1 my-1 w-96 mx-auto rounded-lg bg-transparent placeholder-white border-b-2 focus:ring-2 focus:ring-purple-400 focus:outline-none focus:border-b-0">
                    <div class="mx-auto text-white my-3">
                        <div class="text-white">Mail</div>
                        <textarea name="mail" id="" cols="50" rows="5" class="rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none"></textarea>
                        <div class="flex">
                            <input type="checkbox" name="send">
                            <div class="my-auto">Let us send you an email</div>
                            <button type="submit" name="send" class="px-3 py-2 ml-auto rounded-xl font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Send</button>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col pt-2">
                    <div class="my-3 text-white text-4xl flex font-semibold justify-center">Follow Us</div>
                    <div class="flex space-x-4 place-content-center">
                        <a href="https://www.tokopedia.com/" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/tokopedia.png" alt="" class="w-10 h-10">
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/instagram.png" alt="" class="w-10 h-10">
                        </a>
                        <a href="https://www.facebook.com/" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/facebook.png" alt="" class="w-10 h-10">
                        </a>
                        <a href="https://www.tiktok.com" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/tiktok.png" alt="" class="w-10 h-10">
                        </a>
                    </div>
                    <div class="mt-7 mb-5 text-white text-4xl flex font-semibold justify-center">Contacts</div>
                    <div class="text-white text-center mx-auto text-sm"><span class="text-lg font-bold"><i>Customer Care</i></span><br><b>Email:</b> Glorindo.Care@care.co.id</div>
                    <div class="text-white text-center mx-auto text-sm"><span class="text-lg font-bold"><i>Contact Person</i></span><br><b>Email:</b> Glorindo.Komp@official.co.id<br><b>Phone:</b> 081234567890</div>
                </div>
            </div>
            <div class="text-white text-center mt-5">&copy; Glorindo Komputer Inc. 2022 All Rights Reserved</div>
        </nav>
        </div>
    </form>
</body>
</html>