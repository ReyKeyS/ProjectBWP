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
    function ceklogin($pergi){
        if(isset($_SESSION['data'])){
            header("Location:$pergi.php");
        }
        else{
            echo "<script>alert('Please Login first')</script>";
            header("Location: login.php");
        }
    }

    $queryUser = mysqli_query($conn, "SELECT id_users from users where nama = '".$_SESSION['data']['nama']."'");
    $idUser = mysqli_fetch_row($queryUser)[0];

    $queryTrans = mysqli_query($conn, "SELECT * from htrans where id_users = '$idUser' order by id_htrans desc");
    $cekisi = mysqli_query($conn, "SELECT * from htrans where id_users = '$idUser'");
    $hasilisi=mysqli_fetch_array($cekisi);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="shortcut icon" href="assets/Logo.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              animation:{
                'geserBg':'bgGerak 3s ease infinite'
              },
              keyframes : {
                bgGerak:{
                    '0%,100%':{
                        'background-size':'200% 200%',
                        'background-position':'left center'
                    },
                    '50%':{
                        'background-size':'200% 200%',
                        'background-position':'right center'
                    }
                }
              }
            }
          }
        }
    </script>
</head>
<body>
    <form action="" method="POST">
        <div class="min-h-screen flex flex-col">
    <nav class="h-20 bg-gradient-to-r from-slate-700 via-slate-500 to-slate-300 flex fixed w-full z-10 animate-geserBg">
            <a class="w-24 ml-3 sm:w-28 my-auto sm:ml-3" href="index.php">
                <img src="assets/Logo.jpg" alt="" class="w-8 h-8 sm:w-12 sm:h-12 mx-auto rounded-full">
            </a>
            <a class="my-auto sm:w-64 text-white font-bold text-xs sm:text-2xl" href="index.php">
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
            <div class="my-auto w-1/2 flex sm:mr-4 <?php if($logged) echo 'hidden sm:flex'; ?>">
                <input type="text" name="search" placeholder="Cari Disini" class="px-5 py-2 rounded-l-xl w-full focus:ring-4 focus:ring-purple-400 focus:outline-none cursor-not-allowed" disabled>
                <button name="btnsearch" class="border-l-2 bg-white rounded-r-xl w-12 pl-1 hover:bg-slate-400 disabled:opacity-25 cursor-not-allowed disabled:hover:bg-white" disabled>
                    <img src="assets/search.png" alt="" class="w-6 h-6 sm:w-8 sm:h-8 p-1">
                </button>
            </div>
            <div class="w-20 sm:w-24 my-auto <?php if(!$logged) echo 'hidden sm:block'; ?>">
                <button type="submit" name="build" class="sm:px-5 sm:py-2 px-3 py-2 sm:text-base text-xs flex mx-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Build</button>
            </div>
            <div class="w-16 sm:w-32 my-auto <?php if(!$logged) echo 'hidden sm:block'; ?>">
                <button type="submit" name="cart" class="flex w-16 ml-[6px] sm:ml-0 sm:w-24 sm:px-2 px-px m-auto rounded-2xl bg-slate-600 font-semibold text-white hover:bg-slate-900">
                    <img src="assets/shopping-cart.png" alt="" class="w-8 h-8 -mr-4 sm:mr-0 sm:w-10 sm:h-10 p-1">
                    <span class="my-auto px-3 py-2 sm:p-1 text-xs sm:text-base">Cart</span>
                </button>
            </div>
            <?php
            if($logged){
            ?>
                <div class="w-14 sm:w-28 my-auto ml-4 sm:-ml-5">
                    <button type="submit" name="history" class="h-8 sm:h-10 sm:px-5 sm:py-2 px-2 py-1 sm:text-base text-xs bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">History</button> 
                </div>
                <div class="mt-4 block sm:flex sm:mt-0">
                    <div class="w-16 sm:w-32 my-auto flex flex-col">
                        <a class="my-auto text-center font-bold text-lg">
                            <img src="assets/customer.png" alt="" class="w-3 h-3 sm:w-7 sm:h-7 mx-auto rounded-full">
                            <div class="text-xs sm:text-base">
                                <?= $_SESSION['data']['nama']?>
                            </div>
                        </a>
                    </div>
                    <div class="w-12 sm:w-24 my-auto">  
                        <button type="submit" name="logout" class="sm:px-5 sm:py-2 px-2 py-1 ml-3 sm:ml-0 sm:text-base text-[8px] bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Logout</button>
                    </div>
                </div>
            <?php
                }else{
            ?>
                <div class="w-20 sm:w-40 my-auto flex place-content-center">
                    <button type="submit" formaction="login.php" class="sm:px-5 sm:py-2 px-3 py-2 sm:text-base text-xs mx-3 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Login</button>
                </div>
                <div class="w-20 mr-5 sm:w-40 my-auto flex mx-auto place-content-center">
                    <button type="submit" formaction="register.php" class="sm:px-5 sm:py-2 px-3 py-2 sm:text-base text-xs bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Register</button>
                </div>
            <?php
                }
            ?>
        </nav>
        <div class="w-11/12 mx-auto pt-20 mb-auto flex flex-col">
            <div class="text-4xl font-bold text-center bg-gradient-to-r from-purple-700 to-blue-600 bg-clip-text text-transparent">TRANSACTION HISTORY</div>
            <?php
                if(isset($hasilisi)){
                    while($row = mysqli_fetch_array($queryTrans)){
                        $querySatuProduct = mysqli_query($conn, "SELECT p.nama, dt.qty, p.price, p.gmbr from dtrans dt JOIN products p ON p.id_products = dt.id_products where dt.id_htrans = '".$row["id_htrans"]."'");
                        $SatuProduct = mysqli_fetch_row($querySatuProduct);
            ?>
                <div class="w-full sm:w-1/2 h-64 mx-auto my-3 p-2 flex border rounded-xl shadow-xl">
                    <div class="w-1/4 flex flex-col">
                        <div class="text-sm sm:text-base text-slate-400"><?=$row["invoice"]?> | <?=$row["tanggal"]?></div>
                        <img src="<?=$SatuProduct[3]?>" alt="Imaged" class="w-24 h-24 sm:w-48 sm:h-48 m-auto">
                    </div>
                    <div class="w-2/4 flex flex-col pt-20">
                        <div class="text-lg sm:text-3xl font-semibold"><?=$SatuProduct[0]?></div>
                        <div class="text-sm sm:text-base text-slate-600"><?=$SatuProduct[1]?> x Rp <?=number_format($SatuProduct[2])?></div>
                        <?php
                            if ($querySatuProduct->num_rows > 1){
                                $kurang = (int)$querySatuProduct->num_rows - 1;
                                echo "<div class='text-sm sm:text-base text-slate-600'>+".$kurang." others</div>";
                            }
                        ?>
                        
                    </div>
                    <div class="w-1/4 flex flex-col">
                        <div class="ml-auto">
                            <?php
                                if ($row["status"]=="1"){
                            ?>
                                <a class="text-sm sm:text-2xl text-yellow-500 font-semibold">Pending ???</a>
                            <?php
                                }else if ($row["status"]=="0"){
                            ?>
                                <a class="text-sm sm:text-2xl text-green-400 font-semibold">Done ??? </a>
                            <?php
                                }else if ($row["status"]=="2"){
                            ?>
                                <a class="text-sm sm:text-2xl text-red-400 font-bold">Failed???</a>
                            <?php
                                }
                            ?>                            
                        </div>
                        <div class="pt-14 sm:pt-16">Total</div>
                        <div class="text-base sm:text-xl font-bold">Rp <?=number_format($row["total"])?></div>
                        <a href="detail_transaksi.php?hID=<?=$row["id_htrans"]?>" class="text-[9px] sm:text-lg font-semibold mt-auto bg-gradient-to-r from-purple-700 to-blue-600 bg-clip-text text-transparent hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800 hover:bg-clip-text hover:text-transparent hover:cursor-pointer">See Transaction Detail</a>
                    </div>
                </div>
            <?php
                    }
                }
                else{
                    ?>
                    <div class="w-1/2 pt-20 flex flex-col mx-auto font-mono mt-auto">
                    <div class="mx-auto text-4xl sm:text-9xl font-semibold"><marquee scrollamount="20">ERROR 404</marquee></div>
                    <div class="text-9xl text-center">???</div>
                    <div class="mx-auto text-center text-3xl sm:text-6xl">Your history is empty</div>
                    <div class="mx-auto text-center mt-5 sm:mt-0 text-lg sm:text-3xl">Let's go shopping</div>
                        <div class="mx-auto mt-10">
                            <button type="submit" formaction="index.php" class="mb-5 px-5 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Go Shopping</button>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex fixed bottom-5 right-5 cursor-pointer animate-bounce">
            <a href="#" class="m-auto">
                <img src="assets/up-arrow.png" alt="" class="w-7 h-7">
            </a>
        </div>
        <nav class="h-96 bg-black">
            <div class="flex">
                <div class="w-1/2 pt-5 flex flex-col border-r">
                    <div class="flex justify-center my-1">
                        <div class="text-white mr-5 sm:text-4xl text-xl font-semibold">Send Us Mail</div>
                        <img src="assets/email (1).png" alt="">
                    </div>
                    <input type="text" name="email" placeholder="Email Address" class="px-3 py-1 my-1 sm:w-96 w-40 mx-auto rounded-lg bg-transparent placeholder-white text-white border-b-2 focus:ring-2 focus:ring-purple-400 focus:outline-none focus:border-b-0">
                    <div class="mx-auto text-white my-3">
                        <div class="text-white">Mail</div>
                        <textarea name="mail" id="" class="sm:w-96 sm:h-28 w-48 h-16 rounded-xl text-black focus:ring-2 focus:ring-purple-400 focus:outline-none"></textarea>
                        <div class="flex">
                            <input type="checkbox" name="send">
                            <div class="my-auto sm:text-base text-xs">Let us send you an email</div>
                            <button type="submit" name="send" class="sm:px-3 sm:py-2 p-1 ml-auto rounded-xl font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Send</button>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col pt-2">
                    <div class="my-3 text-white sm:text-4xl text-xl flex font-semibold justify-center">Follow Us</div>
                    <div class="flex space-x-4 place-content-center">
                        <a href="https://tokopedia.link/JiqmfSeYrvb" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/tokopedia.png" alt="" class="sm:w-10 sm:h-10 w-7 h-7">
                        </a>
                        <a href="https://www.instagram.com/ltj.shop/" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/instagram.png" alt="" class="sm:w-10 sm:h-10 w-7 h-7">
                        </a>
                        <a href="https://www.facebook.com/" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/facebook.png" alt="" class="sm:w-10 sm:h-10 w-7 h-7">
                        </a>
                        <a href="https://www.tiktok.com" target="_blank" class="hover:scale-125 duration-200">
                            <img src="assets/tiktok.png" alt="" class="sm:w-10 sm:h-10 w-7 h-7">
                        </a>
                    </div>
                    <div class="mt-7 mb-5 text-white sm:text-4xl text-xl flex font-semibold justify-center">Contacts</div>
                    <div class="text-white text-center mx-auto text-xs"><span class="text-lg font-bold"><i>Customer Care</i></span><br><b>Email:</b> Glorindo.Care@care.co.id</div>
                    <div class="text-white text-center mx-auto text-xs"><span class="text-lg font-bold"><i>Contact Person</i></span><br><b>Email:</b> Glorindo.Komp@official.co.id<br><b>Phone:</b> 081234567890</div>
                </div>
            </div>
            <div class="text-white text-center sm:text-base text-sm mt-5">&copy; Glorindo Komputer Inc. 2022 All Rights Reserved</div>
        </nav>
        </div>
    </form>
</body>
</html>