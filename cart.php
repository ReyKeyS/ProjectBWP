<?php
    require_once("connection.php");
    $logged=false;
    if(isset($_SESSION['data'])){
        $logged=true;
    }
    else{
        header('Location:index.php');
    }
    if(isset($_POST['home'])){
        header('Location:index.php');
    }
    if (isset($_POST["logout"])){
        unset($_SESSION['data']);
        header("Location: index.php");
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

    $queryUser = mysqli_query($conn, "SELECT id_users from users where nama = '".$_SESSION['data']['nama']."'");
    $idUser = mysqli_fetch_row($queryUser)[0];
    $cekisi=mysqli_query($conn,"SELECT * from carts where id_users = '$idUser'");
    $hasilisi=mysqli_fetch_array($cekisi);
    
    if (isset($_POST["buy"])){
        date_default_timezone_set("Asia/Jakarta");        
        $now = date("Y-m-d H:i:s");

        // Generate ID Htrans
        $newHtrans = "HS";
        $maxHt = mysqli_query($conn, "SELECT max(substr(id_htrans,3)) from htrans");
        $maxHtUrut = mysqli_fetch_row($maxHt)[0] + 1;
        $newHtrans .= str_pad($maxHtUrut, 4, "0", STR_PAD_LEFT);
        // Generate Invoice
        $newInv = "INV";
        $tahun = date("y");
        $bulan = date("m");
        $hari = date("d");
        $newInv .= $tahun.$bulan.$hari;
        
        $queryNewestInv = mysqli_query($conn, "SELECT max(substr(invoice, 10)) from htrans where invoice like '$newInv%'");
        $newestInv = mysqli_fetch_row($queryNewestInv)[0] + 1;
        $newInv .= str_pad($newestInv, 3, "0", STR_PAD_LEFT);
                
        // Simpen total di variable + unset SESSION
        $grandtotal = "";
        if (isset($_SESSION["grandtotal"])){
            $grandtotal = $_SESSION["grandtotal"];
        }
        unset($_SESSION["grandtotal"]);

        // Checkbox Rakit
        $statusRakit = '0';
        if (isset($_SESSION["tekoBuild"])){
            $statusRakit = '1';
            unset($_SESSION["tekoBuild"]);
        }

        mysqli_query($conn, "INSERT INTO htrans values('$newHtrans', '$idUser', '$newInv', '$now', $statusRakit ,'$grandtotal', 1)");

        // DTRANS
        $queryIsiCart = mysqli_query($conn, "SELECT c.id_products, c.qty, p.price from carts c JOIN products p on p.id_products = c.id_products where c.id_users ='$idUser'");
        while($row = mysqli_fetch_row($queryIsiCart)){
            $newDtrans = "DS";
            $maxDt = mysqli_query($conn, "SELECT max(substr(id_dtrans,3)) from dtrans");
            $maxDtUrut = mysqli_fetch_row($maxDt)[0] + 1;
            $newDtrans .= str_pad($maxDtUrut, 5, "0", STR_PAD_LEFT);
            
            $idBarangCur = $row[0];
            $qtyCur = $row[1];
            $subtotalCur = intval($row[1]) * intval($row[2]);
            mysqli_query($conn, "INSERT INTO dtrans values('$newDtrans', '$newHtrans', '$idBarangCur', '$qtyCur', '$subtotalCur')");
        }

        // Delete Cart
        mysqli_query($conn, "DELETE FROM carts where id_users = '$idUser'");
        header("Location: history.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body onload="load_ajax()">
    <form action="#" method="POST">
        <div class="<?php echo(isset($idUser) ? 'h-screen flex flex-col':'')?>">

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
    </form>
        <?php
            if(isset($hasilisi)){
                ?>
                
        <div class="pt-20 flex mb-auto" id="list_cart">
            <!-- <div class="w-2/3 flex flex-col place-content-center">
                <div class="text-3xl font-semibold mx-auto">Your Cart</div>
                <div class="w-3/4 ml-auto">
                    <div class="w-full my-3 border rounded-md shadow-lg overflow-hidden mb-10 flex">
                        <img src="https:/source.unsplash.com/600x400" alt="" class="p-5 h-48 w-48">
                        <div class="flex flex-col my-auto">
                            <div class="text-2xl font-semibold">Image Title</div>
                            <div>Rp 120.000</div>
                        </div>
                        <div class="ml-auto my-auto mr-3">
                            <button type="submit" name="delete" class="px-5 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">Delete</button>
                            <div class="text-center">1</div>
                        </div>
                    </div>
                    <div class="w-full my-3 border rounded-md shadow-lg overflow-hidden mb-10 flex">
                        <img src="https:/source.unsplash.com/600x400" alt="" class="p-5 h-48 w-48">
                        <div class="flex flex-col my-auto">
                            <div class="text-2xl font-semibold">Image Title</div>
                            <div>Rp 120.000</div>
                        </div>
                        <div class="ml-auto my-auto mr-3">
                            <button type="submit" name="delete" class="px-5 py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600">Delete</button>
                            <div class="text-center">1</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/3">
                <div class="w-1/3 px-5 py-3 flex border rounded-xl shadow-xl flex-col mx-auto mt-14">
                    <div>Total:</div>
                    <div>Rp 120.000</div>
                    <button type="submit" name="buy" class="px-3 py-1 font-semibold text-white my-2 ml-auto rounded-lg bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Buy</button>
                </div>
            </div> -->
        </div>
        <?php
            }
            else{
                ?>
                <div class="w-1/2 pt-20 flex flex-col mx-auto font-mono mt-auto">
                    <div class="mx-auto text-9xl font-semibold"><marquee scrollamount="20">ERROR 404</marquee></div>
                    <div class="text-9xl text-center">☠</div>
                    <div class="mx-auto text-6xl">Your cart is empty</div>
                    <div class="mx-auto text-3xl">Let's go shopping</div>
                    <div class="mx-auto mt-10">
                        <button type="submit" formaction="index.php" class="mb-5 px-5 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Go Shopping</button>
                    </div>
                </div>
                <?php
            }
        ?>
    <form action="#" method="POST">
        <nav class="h-96 bg-black <?php echo(isset($idUser) ? 'mt-auto':'')?>">
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
    <script lang="javascript">
        list_cart;
        function load_ajax(){
            list_cart = document.getElementById("list_cart");
            fetch_cart();
        }

        function fetch_cart(){
            r = new XMLHttpRequest();
            r.onreadystatechange = function(){
                if ((this.readyState==4) && (this.status==200)){
                    list_cart.innerHTML = this.responseText;
                }
            }
            r.open("POST", "cart_fetch.php");
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send(`idUser=<?=$idUser?>`);
        }

        function update_cart(obj){
            curQty = obj.value;
            idProduct = obj.getAttribute("idProduct");

            r = new XMLHttpRequest();
            r.onreadystatechange = function(){
                if ((this.readyState==4) && (this.status==200)){
                    fetch_cart();
                }
            }
            r.open("POST", "cart_update.php");
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send(`idProduct=${idProduct}&curQty=${curQty}`);
        }

        function delete_cart(obj){
            idProduct = obj.value;

            r = new XMLHttpRequest();
            r.onreadystatechange = function(){
                if ((this.readyState==4) && (this.status==200)){
                    fetch_cart();
                    if (this.responseText == "0"){
                        clearInterval(refreshCart);
                        location.reload();
                    }
                }
            }
            r.open("POST", "cart_delete.php");
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send(`idProduct=${idProduct}&idUser=<?=$idUser?>`);
        }

    </script>
</body>
</html>