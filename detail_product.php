<?php
    require_once("connection.php");
    $logged = false;
    if (isset($_SESSION['data'])){
        $logged = true;        
        $queryUser = mysqli_query($conn, "SELECT id_users from users where nama = '".$_SESSION['data']['nama']."'");
        $idUser = mysqli_fetch_row($queryUser)[0];
    }
    if(isset($_POST['home'])){
        header('Location:index.php');
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
        
    $idProduct = "";
    if (isset($_GET["ID"])){
        $idProduct = $_GET["ID"];
        $queryProduct = mysqli_query($conn, "SELECT * from products where id_products = '$idProduct' and status = 1 and stok > 0");
        $dataProduct = mysqli_fetch_array($queryProduct);
        if (!isset($dataProduct)){
            header("Location: index.php");    
        }
    }else{
        header("Location: index.php");
    }
    
    if(isset($_POST['tambah'])){
        if(!$logged){
            echo "<script>alert('Please Login first')</script>";
            header("Location: login.php");
        }
        else{
            $qty = $_POST["amountProduct"];

            $queryAdaGa = mysqli_query($conn, "SELECT * from carts where id_users = '$idUser' and id_products = '$idProduct'");
            $dataAdaGa = mysqli_fetch_array($queryAdaGa);

            if ($queryAdaGa->num_rows == 0){
                mysqli_query($conn, "INSERT INTO carts values('$idUser', '$idProduct', '$qty')");
            }else{
                $stokYgAda = $dataProduct["stok"];
                $curQty = $dataAdaGa["qty"];
                $curQty += $qty;
                if ($curQty > $stokYgAda){
                    $curQty = $stokYgAda;
                }
                mysqli_query($conn, "UPDATE carts SET qty = $curQty WHERE id_users = '$idUser' and id_products = '$idProduct'"); 
            }
            if (isset($_SESSION["tekoBuild"]))
                unset($_SESSION["tekoBuild"]);
            header("Location: cart.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Products</title>
    <link rel="shortcut icon" href="assets/Logo.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="" method="POST">
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
                        <img src="assets/customer.png" alt="" class="w-7 h-7 mx-auto rounded-full">
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
                <div class="w-40 my-auto flex place-content-center">
                    <button type="submit" formaction="login.php" class="px-5 py-2 mx-3 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Login</button>
                </div>
                <div class="w-40 my-auto flex mx-auto place-content-center">
                    <button type="submit" formaction="register.php" class="px-5 py-2 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Register</button>
                </div>
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
                <div class="flex mt-20 gap-2">
                    <div class="my-auto font-medium">Amount : </div>
                    <input type="number" name="amountProduct" value="1" class="w-14 border rounded-xl text-center pl-3" min="1" max="<?=$dataProduct["stok"]?>">
                    <button type="submit" name="tambah" class="px-5 py-3 w-32 border bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Add to Cart</button>

                </div>
                <div class="flex mt-14">
                    <a class="w-12 h-12 border-2 border-slate-700 bg-white rounded-full">
                        <img src="assets/logotransparanLTJ.png" alt="" class="w-full h-full mx-auto">
                    </a>
                    <a class="my-auto ml-3 font-bold text-2xl">Glorindo Komputer</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-slate-600 font-bold text-4xl px-10 py-6">Others</div>
            <div class="grid grid-cols-4 gap-x-16 mx-auto my-8">
            <?php
                $queryJumlah = mysqli_query($conn, "SELECT count(*) from products where status = 1 and stok > 0");
                $jumlahP = mysqli_fetch_row($queryJumlah)[0];
                $angkaHasilRand = [];
                for ($i=0; $i < 4; $i++) {
                    do {
                        $cekUniq = false;
                        $rand = rand(1,$jumlahP);
                        for ($j=0; $j < $i; $j++) { 
                            if ($angkaHasilRand[$j] == $rand){
                                $cekUniq = true;
                                break;
                            }
                        }
                    } while ($cekUniq);
                    if (!$cekUniq){
                        $angkaHasilRand[$i] = $rand;
                        $idOthers = "PR".str_pad(strval($rand), 4, "0", STR_PAD_LEFT);
                        $queryOthers = mysqli_query($conn, "SELECT * from products where id_products = '$idOthers' and status = 1 and stok > 0");
                        $dataOthers = mysqli_fetch_array($queryOthers);
                    
                    // $rand = rand(1,$jumlahP);
            ?>
                <button class="w-96 h-full shadow-lg overflow-hidden mx-auto rounded-lg p-5" formaction="detail_product.php?ID=<?=$dataOthers["id_products"]?>";>
                    <img src='<?=$dataOthers["gmbr"]?>' alt="" class="w-full h-11/12">
                    <hr class="mt-3">
                    <div class="px-6 py-3">
                        <div class="font-bold text-xl mb-2 text-slate-700"><?=$dataOthers["nama"]?></div>
                        <p class="text-xl text-slate-700">Rp <?=number_format($dataOthers["price"])?></p>
                    </div>
                </button>
            <?php
                    }
                }
            ?>
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
                        <a href="https://tokopedia.link/JiqmfSeYrvb" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/tokopedia.png" alt="" class="w-10 h-10">
                        </a>
                        <a href="https://www.instagram.com/ltj.shop/" target="_blank" class="hover:scale-125 duration-200">
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