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
    if(isset($_POST['cart'])){
        ceklogin('cart');
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

    if (isset($_POST["addToCart"])){
        $cbProc = $_POST["cbProc"];
        $cbMobo = $_POST["cbMobo"];
        $cbRam = $_POST["cbRam"];
        $cbVga = $_POST["cbVga"];
        $cbSsd = $_POST["cbSsd"];
        $cbHdd = $_POST["cbHdd"];
        $cbPsu = $_POST["cbPsu"];
        $cbCasing = $_POST["cbCasing"];

        if ($cbProc != "" && $cbMobo != "" && $cbRam != "" && $cbVga != "" && $cbSsd != "" && $cbHdd != "" && $cbPsu != "" && $cbCasing != ""){
            $qtyProc = $_POST["qtyProc"];
            $qtyMobo = $_POST["qtyMobo"];
            $qtyRam = $_POST["qtyRam"];
            $qtyVga = $_POST["qtyVga"];
            $qtySsd = $_POST["qtySsd"];
            $qtyHdd = $_POST["qtyHdd"];
            $qtyPsu = $_POST["qtyPsu"];
            $qtyCasing = $_POST["qtyCasing"];

            // Delete Cart sblm
            mysqli_query($conn, "DELETE FROM carts where id_users = '$idUser'");
            // Input Cart baru
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbProc', '$qtyProc')");
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbMobo', '$qtyMobo')");
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbRam', '$qtyRam')");
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbVga', '$qtyVga')");
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbSsd', '$qtySsd')");
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbHdd', '$qtyHdd')");
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbPsu', '$qtyPsu')");
            mysqli_query($conn, "INSERT INTO carts values('$idUser', '$cbCasing', '$qtyCasing')");

            $_SESSION["tekoBuild"] = "ya";
            
            echo "<script>alert('Your previous cart has been replaced!')</script>";
            header("Location: cart.php");
        }else{
            echo "<script>alert('You haven't choose a part/some parts!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building PC</title>
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
<body onload="load_ajax()">
    <form action="" method="POST">
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
                    <img src="assets/search.png" alt="" class="w-8 h-8 p-1">
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
        <div class="w-full sm:w-5/6 pt-20 mx-auto mb-5 flex flex-col" id="simulasi">
            <!-- <div class="ml-10 mb-10 text-4xl font-bold">Build Your PC</div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">Processor</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">Motherboard</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">RAM</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">VGA</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">SSD</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">HDD</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">PSU</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">Casing</div>
                <div class="flex justify-end ml-20 w-2/3">
                    <select name="" id="" class="w-[900px] ml-auto border border-slate-400 rounded-lg focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        <option value="">mobo1</option>
                        <option value="">mobo2</option>
                        <option value="">mobo3</option>
                    </select>
                </div>
                <input type="number" value="1" class="border border-slate-400 rounded-lg">
                <div class="flex">
                    Rp: <input type="text" class="border border-slate-400 rounded-lg" disabled>
                </div>
            </div>
            <div class="ml-auto flex">
                <div class="text-2xl font-semibold">Grand Total : Rp</div>
                <input type="text" class="rounded-lg border border-slate-400" disabled>
            </div>
            <div class="ml-auto flex gap-2">
                <button type="submit" class="px-5 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Reset</button>
                <button type="submit" class="px-5 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Save</button>
            </div> -->
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
    </form>
    <script lang="javascript">
        simulasi;
        proc, mobo, ram, vga, ssd, hdd, psu, casing;
        pr,mo,ra,vg,ss,hd,ps,ca;
        function load_ajax(){
            simulasi = document.getElementById("simulasi");
            proc="", mobo="", ram="", vga="", ssd="", hdd="", psu="", casing="";
            pr=0,mo=0,ra=0,vg=0,ss=0,hd=0,ps=0,ca=0;
            fetch_build();
        }

        function fetch_build(){
            r = new XMLHttpRequest();
            r.onreadystatechange = function(){
                if ((this.readyState==4) && (this.status==200)){
                    simulasi.innerHTML = this.responseText;

                }
            }
            r.open("POST", "build_fetch.php");
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send(`proc=${proc}&pr=${pr}&mobo=${mobo}&mo=${mo}&ram=${ram}&ra=${ra}&vga=${vga}&vg=${vg}&ssd=${ssd}&ss=${ss}&hdd=${hdd}&hd=${hd}&psu=${psu}&ps=${ps}&casing=${casing}&ca=${ca}`);
        }

        function change_proc(obj){
            proc = obj.value;
            pr=1;
            fetch_build();
        }
        function change_mobo(obj){
            mobo = obj.value;
            mo=1;
            fetch_build();
        }
        function change_ram(obj){
            ram = obj.value;
            ra=1;
            fetch_build();
        }
        function change_vga(obj){
            vga = obj.value;
            vg=1;
            fetch_build();
        }
        function change_ssd(obj){
            ssd = obj.value;
            ss=1;
            fetch_build();
        }
        function change_hdd(obj){
            hdd = obj.value;
            hd=1;
            fetch_build();
        }
        function change_psu(obj){
            psu = obj.value;
            ps=1;
            fetch_build();
        }
        function change_casing(obj){
            casing = obj.value;
            ca=1;
            fetch_build();
        }
        
        function amount_pr(obj){
            pr = obj.value;
            fetch_build();
        }
        function amount_mo(obj){
            mo = obj.value;
            fetch_build();
        }
        function amount_ra(obj){
            ra = obj.value;
            fetch_build();
        }
        function amount_vg(obj){
            vg = obj.value;
            fetch_build();
        }
        function amount_ss(obj){
            ss = obj.value;
            fetch_build();
        }
        function amount_hd(obj){
            hd = obj.value;
            fetch_build();
        }
        function amount_ps(obj){
            ps = obj.value;
            fetch_build();
        }
        function amount_ca(obj){
            ca = obj.value;
            fetch_build();
        }   

    </script>
</body>
</html>