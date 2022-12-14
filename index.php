<?php
    require_once('connection.php');
    $logged = false;
    if (isset($_SESSION['data'])){
        $logged = true;
    }
    if(isset($_SESSION['page'])){
        unset($_SESSION['page']);
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
            $_SESSION['page']=$pergi;
            header("Location: login.php");
        }
    }
    $search = "";
    if (isset($_POST["btnSearch"])){
        $search = $_POST["search"];
    }
    $minimum = 0;
    $maximum = 0;
    $sorted = "asc";
    $cate = "";
    $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' ORDER BY nama $sorted");
    if (isset($_POST["btnApply"])){
        $minimum = $_POST["min"];
        $maximum = $_POST["maks"];
        
        if ($minimum <= $maximum){ 
            $sorted = $_POST["sort"];
            $cate = $_POST["categoryCombo"];
        }else if ($minimum > $maximum){
            $minimum = 0;
            $maximum = 0;
            echo "<script>alert('Invalid Filter!')</script>";
        }

        if ($cate != ""){
            if ($minimum != 0 || $maximum != 0){
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted");
            }else{
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' ORDER BY nama $sorted");
            }
        }else{
            if ($minimum != 0 || $maximum != 0){
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted");
            }else{
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' ORDER BY nama $sorted");
            }
        }
    }    
    if (isset($_POST["btnReset"])){
        $minimum = 0;
        $maximum = 0;
        $sorted = "asc";
        $cate = "";

        if ($cate != ""){
            if ($minimum != 0 || $maximum != 0){
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted");
            }else{
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and id_cate = '$cate' and nama like '%$search%' ORDER BY nama $sorted");
            }
        }else{
            if ($minimum != 0 || $maximum != 0){
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' and price > $minimum and price < $maximum ORDER BY nama $sorted");
            }else{
                $queryPage = mysqli_query($conn, "SELECT * from products where status = 1 and stok > 0 and nama like '%$search%' ORDER BY nama $sorted");
            }
        }
    }
    $bnykPage = intval($queryPage->num_rows)/12;

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="assets/Logo.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              animation:{
                'gerak':'goyang 3s ease-in-out infinite',
                'tampil' : 'muncul 1.25s ease-in-out 1',
                'tampilgambar': 'hadir 1.5s ease-in-out 1',
                'geserBg':'bgGerak 3s ease infinite'
              },
              keyframes : {
                goyang:{
                  '0%, 100%' : {transform: 'rotate(-3deg)'},
                  '50%' :{transform:'rotate(3deg)'}
                },
                muncul:{
                    '0%' : {
                        opacity: 0,
                        transform:'translateX(-10%)'
                    },
                    '100%':{
                        opacity:1,
                        transform:'translateX(0%)'
                    }
                },
                hadir:{
                    '0%':{
                        opacity:0
                    },
                    '100%':{
                        opacity:1
                    }
                },
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
       <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body onload="load_ajax()">
    <form action="#" method="POST">
        <nav class="h-20 bg-gradient-to-r from-slate-700 via-slate-500 to-slate-300 flex fixed w-full z-10 animate-geserBg">
            <a class="w-24 ml-3 sm:w-28 my-auto sm:ml-3" href="#">
                <img src="assets/Logo.jpg" alt="" class="w-8 h-8 sm:w-12 sm:h-12 mx-auto rounded-full">
            </a>
            <a class="my-auto sm:w-64 text-white font-bold text-xs sm:text-2xl" href="#">
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
                <input type="text" name="search" placeholder="Cari Nama Barang Disini" value="<?=$search?>" class="sm:px-5 sm:py-2 text-sm sm:text-base px-2 py-1 rounded-l-xl w-full focus:ring-4 focus:ring-purple-400 focus:outline-none">
                <button name="btnSearch" class="border-l-2 bg-white rounded-r-xl w-12 pl-1 hover:bg-slate-400">
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
    </form>
        <div class="flex flex-col pt-20">
            <div class="w-full sm:h-[650px] h-64 bg-black">
                <div class="flex flex-row w-full h-full sm:bg-[center_bottom_-17rem] sm:bg-auto bg-cover bg-center animate-tampilgambar" style="background-image: url('assets/setup.jpg');" id="gambar">
                    <div class="w-1/3 m-auto text-center text-white font-bold sm:text-3xl text-sm animate-tampil">
                        Welcome To Our Shop
                        <br>
                        "Bringing the best Quality of Service"
                    </div>
                    <div class="w-2/3"></div>
                </div>
            </div>
            <div class="w-full relative">
            <form action="#" method="POST">
                <div class="w-60 px-1 py-2 sm:w-72 sm:px-3 sm:py-4 h-[335px] bg-gradient-to-br from-slate-500 to-slate-900 rounded-t-xl flex flex-col fixed bottom-0 left-0 translate-y-3/4 animate-pulse hover:animate-none hover:translate-y-0 duration-500">
                    <div class="text-white font-semibold text-2xl text-center mb-1">Filter</div>
                    <div class="flex">
                        <div class="my-1 text-white font-medium">Category</div>
                        <select class="form-select ml-3 mt-1 w-28 sm:w-[155px] h-7 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none text-sm" aria-label="Default select example" name="categoryCombo">
                            <option <?php if($cate == "") echo "selected" ?> value="">Choose the Category</option>
                        <?php
                            $categoryCB = mysqli_query($conn, "SELECT * from categories");
                            while($row = mysqli_fetch_row($categoryCB)){
                        ?>        
                            <option <?php if($cate == $row[0]) echo "selected" ?> value="<?=$row[0];?>"> <?= $row[1] ?> </option>
                        <?php
                            }
                        ?>
                        </select><br>
                    </div>
                    <div class="my-1 text-white font-medium">Price</div>
                    <input type="text" name="min" placeholder="Harga minimum" class="px-5 py-1 my-1 w-3/4 mx-auto rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" value="<?=$minimum?>">
                    <input type="text" name="maks" placeholder="Harga maksimum" class="px-5 py-1 my-1 w-3/4 mx-auto rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" value="<?=$maximum?>">
                    <div class="flex pl-1 pr-5 mt-1">
                        <button type="submit" name="btnReset" class="sm:px-5 sm:py-2 px-2 py-1 mr-3 ml-auto rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Reset</button>
                        <button type="submit" name="btnApply" class="sm:px-5 sm:py-2 px-2 py-1 mr-3 ml-auto rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Apply</button>
                    </div>
                    <div class="my-1 text-white font-medium">Sort</div>
                    <div class="flex flex-row">
                        <input type="radio" name="sort" id="asc" value="asc" class="ml-3 cursor-pointer" <?php if($sorted == "asc") echo "checked"; ?>>
                        <div class="text-white font-medium">Ascending</div>
                    </div>
                    <div class="flex flex-row">
                        <input type="radio" name="sort" id="desc" value="desc" class="ml-3 cursor-pointer" <?php if($sorted == "desc") echo "checked"; ?>>
                        <div class="text-white font-medium">Descending</div>
                    </div>
                </div>
                <div class="text-slate-600 font-bold sm:text-4xl text-3xl px-10 py-6" id="judulIndex">
                    <?php 
                        if ($cate == "")
                            echo "All Products";
                        else{
                            $resultFilterCate = mysqli_query($conn, "SELECT nama from categories where id_cate = '$cate'");
                            echo mysqli_fetch_row($resultFilterCate)[0];
                        }
                    ?>
                </div>
                <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex fixed bottom-5 right-5 cursor-pointer animate-bounce">
                    <a href="#" class="m-auto">
                        <img src="assets/up-arrow.png" alt="" class="w-7 h-7">
                    </a>
                </div>
            </form>
                <div id=product_list>

                </div>                
            </div>
        </div>
    <form action="" method="POST">
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
        <!-- <div class="flex flex-col">
            <div class="w-full h-[600px] bg-center">
                
            </div>
        </div> -->
    </form>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration:1500
        });
    </script>
    <script lang="javascript">
        judulIndex, product_list, page = 1;
        function load_ajax(){
            judulIndex = document.getElementById("judulIndex");
            product_list = document.getElementById("product_list");
            fetch_product();
        }
        // refreshProduct = setInterval(fetch_product, 500);
        setTimeout(myFunction, 3000);

        var konter=0;
        const gmbr=["url('assets/setup.jpg')","url('assets/setup2.jpg')","url('assets/setup3.jpg')"]
        function myFunction() {
            if(konter==0){
                document.getElementById("gambar").style.backgroundImage = gmbr[0];
                konter++;
                setTimeout(myFunction, 3000)
            }
            else if(konter==1){
                document.getElementById("gambar").style.backgroundImage = gmbr[1];
                konter++;
                setTimeout(myFunction, 3000)
            }
            else{
                document.getElementById("gambar").style.backgroundImage = gmbr[2];
                konter=0;
                setTimeout(myFunction, 3000)
            }
            // document.getElementById("gambar").style.backgroundImage = "url('assets/setup2.jpg')";
        }
        function fetch_product(){
            r = new XMLHttpRequest();
            r.onreadystatechange = function(){
                if ((this.readyState==4) && (this.status==200)){
                    product_list.innerHTML = this.responseText;
                }
            }
            r.open("POST", "index_product_fetch.php");
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send(`search=<?=$search?>&cate=<?=$cate?>&sorted=<?=$sorted?>&minimum=<?=$minimum?>&maximum=<?=$maximum?>&page=${page}`);
        }

        function prev_btn(){
            if (page > 1){
                page--;
                fetch_product();
            }
        }

        function next_btn(){
            if (page < <?=$bnykPage?>){
                page++;
                fetch_product();
            }
        }

        function paging(pageTerpilih){
            page = pageTerpilih;
            fetch_product();
        }
        
    </script>

</body>
</html>