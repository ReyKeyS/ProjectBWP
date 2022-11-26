<?php
    require_once("connection.php");
    $logged = false;
    if (isset($_SESSION['data'])){
        $logged = true;
    }
    if(isset($_POST['home'])){
        header('Location:index.php');
    }
    if (isset($_POST["logout"])){
        unset($_SESSION['data']);
        header("Location: index.php");
    }
    if(isset($_POST['cart'])){
        if(isset($_SESSION['data'])){
            header("Location:cart.php");
        }
        else{
            echo "<script>alert('Please Login first')</script>";
        }
    }
    if(isset($_POST['tambah'])){
        if(!$logged){
            echo "<script>alert('Please Login first')</script>";
        }
        else{

        }
    }

    $idProduct = "";
    if (isset($_GET["ID"])){
        $idProduct = $_GET["ID"];
        $queryProduct = mysqli_query($conn, "SELECT * from products where id_products = '$idProduct' and status = 1");
        $dataProduct = mysqli_fetch_array($queryProduct);
        if (!isset($dataProduct)){
            header("Location: index.php");    
        }
    }else{
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="" method="POST">
        <nav class="h-20 bg-gradient-to-r from-slate-700 via-slate-500 to-slate-300 flex fixed w-full z-10">
            <a class="w-32 my-auto ml-3">
                <img src="assets/gonadi.jpg" alt="" class="w-12 h-12 mx-auto rounded-full">
            </a>
            <a class="my-auto w-80 text-white font-bold text-2xl">
            <?php
                    if(isset($_SESSION['data'])){
                        echo $_SESSION['data']['nama'];
                    }
                    else{
                        echo "Glorindo Komputer";
                    }
                ?> 
            </a>
            <div class="my-auto w-1/2 flex">
                <input type="text" name="search" placeholder="Cari Disini" class="px-5 py-2 rounded-l-xl w-full focus:ring-4 focus:ring-purple-400 focus:outline-none cursor-not-allowed" disabled>
                <button name="btnsearch" class="border-l-2 bg-white rounded-r-xl w-12 pl-1 hover:bg-slate-400 disabled:opacity-25 cursor-not-allowed disabled:hover:bg-white" disabled>
                    <img src="assets/search.png" alt="" class="w-8 h-8 p-1">
                </button>
            </div>
            <!-- <div class="w-32 my-auto">
                <button type="submit" name="rakit" class="px-5 py-2 ml-7 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Rakit</button>
            </div> -->
            <button type="submit" name="home" class="flex p-auto m-auto rounded-2xl bg-slate-600 font-semibold text-white hover:bg-slate-900">
                <img src="assets/home.png" alt="" class="w-10 h-10 p-1">
                <span class="my-auto p-1">Home</span>
            </button>
            <button type="submit" name="cart" class="flex p-auto m-auto rounded-2xl bg-slate-600 font-semibold text-white hover:bg-slate-900">
                <img src="assets/shopping-cart.png" alt="" class="w-10 h-10 p-1">
                <span class="my-auto p-1">Cart</span>
            </button>
            <?php
            if($logged){
            ?>
                <button submit="submit" name="logout" class="px-5 py-2 m-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Logout</button>
            <?php
                }else{
            ?>
                <button submit="submit" formaction="login.php" class="px-5 py-2 m-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Login</button>
                <button submit="submit" formaction="register.php" class="px-5 py-2 m-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Register</button>
            <?php
                }
            ?>
        </nav>
        <div class="w-2/3 pt-28 mx-auto flex">
            <div class="w-1/3">
                <img src="<?=$dataProduct["gmbr"]?>" alt="">
            </div>
            <div class="w-2/3 flex flex-col px-10">
                <div class="text-4xl font-semibold my-2"><?=$dataProduct["nama"]?></div>
                <div class="text-2xl font-medium">Rp <?=number_format($dataProduct["price"])?></div>
                <div class="mt-3">Stock : <?=$dataProduct["stok"]?></div>
                <div class="mt-3 text-lg font-medium">Brand : <?php if ($dataProduct["brand"] != "") echo $dataProduct["brand"]; else echo "-";?></div>
                <div class="mt-8 font-medium"><?=$dataProduct["desc"]?></div>
                <button type="submit" name="tambah" class="px-5 py-3 border bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800 w-32 mt-20">Add to Cart</button>
                <div class="flex mt-14">
                    <a class="">
                        <img src="assets/Logo.jpg" alt="" class="w-12 h-12 mx-auto rounded-full">
                    </a>
                    <a class="my-auto ml-3 font-bold text-2xl">Glorindo Komputer</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-slate-600 font-bold text-4xl px-10 py-6">Others</div>
            <div class="grid grid-cols-4 gap-x-16 mx-auto my-8">
            <?php
                $queryJumlah = mysqli_query($conn, "SELECT count(*) from products where status = 1");
                $jumlahP = mysqli_fetch_row($queryJumlah)[0];
                $angkaHasilRand = [];
                for ($i=0; $i < 4; $i++) { 
                    $cekUniq = false;
                    do {
                        $rand = rand(0,$jumlahP-1);
                    } while ($cekUniq);
                }
            ?>
                <button class="w-96 h-full shadow-lg overflow-hidden mx-auto rounded-lg p-5" formaction="detail_product.php?ID=<?=$row["id_products"]?>";>
                    <img src='https://source.unsplash.com/600x400' alt="" class="w-full h-11/12">
                    <hr class="mt-3">
                    <div class="px-6 py-3">
                        <div class="font-bold text-xl mb-2 text-slate-700">Image Title</div>
                        <p class="text-xl text-slate-700">Rp 120.000</p>
                    </div>
                </button>
            </div> 
        </div>
        <nav class="h-96 bg-black">
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
    </form>
</body>
</html>