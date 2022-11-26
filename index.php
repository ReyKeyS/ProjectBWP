<?php
    require_once('connection.php');
    $logged = false;
    if (isset($_SESSION['data'])){
        $logged = true;
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
    if(isset($_POST['build'])){
        if(isset($_SESSION['data'])){
            header("Location:build.php");
        }
        else{
            echo "<script>alert('Please Login first')</script>";
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
    }
    if (isset($_POST["btnReset"])){
        $minimum = 0;
        $maximum = 0;
        $sorted = "asc";
        $cate = "";
    }
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              animation:{
                'gerak':'goyang 3s ease-in-out infinite',
                'tampil' : 'muncul 1.25s ease-in-out 1',
                'tampilgambar': 'hadir 1.5s ease-in-out 1'
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
                }
              }
            }
          }
        }
      </script>
</head>
<body onload="load_ajax()">
    <form action="#" method="POST">
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
                <input type="text" name="search" placeholder="Cari Disini" value="<?=$search?>" class="px-5 py-2 rounded-l-xl w-full focus:ring-4 focus:ring-purple-400 focus:outline-none">
                <button name="btnSearch" class="border-l-2 bg-white rounded-r-xl w-12 pl-1 hover:bg-slate-400">
                    <img src="assets/search.png" alt="" class="w-8 h-8 p-1">
                </button>
            </div>
            <div class="w-32 my-auto">
                <button type="submit" name="build" class="px-5 py-2 ml-7 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Build</button>
            </div>
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
        <div class="flex flex-col pt-20">
            <div class="w-full h-[650px] bg-black" >
                <div class="flex flex-row w-full h-full bg-[center_bottom_-17rem] animate-tampilgambar" style="background-image: url('assets/setup.jpg');">
                    <div class="w-1/3 m-auto text-center text-white font-bold text-3xl animate-tampil">
                        Welcome To Our Shop
                        <br>
                        "Bringing the best Quality of Service"
                    </div>
                    <div class="w-2/3"></div>
                </div>
            </div>
            <div class="w-full relative">
                <div class="w-72 px-3 py-4 h-[335px] bg-gradient-to-br from-slate-500 to-slate-900 rounded-t-xl flex flex-col fixed bottom-0 left-0 translate-y-3/4 animate-pulse hover:animate-none hover:translate-y-0 duration-500">
                    <div class="text-white font-semibold text-2xl text-center mb-1">Filter</div>
                    <div class="flex">
                        <div class="my-1 text-white font-medium">Category</div>
                        <select class="form-select ml-3 mt-1 w-[155px] h-7 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none text-sm" aria-label="Default select example" name="categoryCombo">
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
                        <button type="submit" name="btnReset" class="px-5 py-2 mr-3 ml-auto rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Reset</button>
                        <button type="submit" name="btnApply" class="px-5 py-2 mr-3 ml-auto rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Apply</button>
                    </div>
                    <div class="my-1 text-white font-medium">Sort</div>
                    <div class="flex flex-row">
                        <input type="radio" name="sort" id="asc" value="asc" class="ml-3" <?php if($sorted == "asc") echo "checked"; ?>>
                        <div class="text-white font-medium">Ascending</div>
                    </div>
                    <div class="flex flex-row">
                        <input type="radio" name="sort" id="desc" value="desc" class="ml-3" <?php if($sorted == "desc") echo "checked"; ?>>
                        <div class="text-white font-medium">Descending</div>
                    </div>
                </div>
                <div class="text-slate-600 font-bold text-4xl px-10 py-6" id="judulIndex">
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
                <div class="grid grid-cols-4 gap-y-16 mx-auto mt-2 mb-16" id="product_list">
                    <!-- <div class="w-96 h-96 shadow-lg overflow-hidden mb-10 mx-auto rounded-lg">
                        <img src="https:/source.unsplash.com/600x400" alt="">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 text-slate-700">Image Title</div>
                            <p class="text-md text-slate-600">Rp 120.000</p>
                            <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Add to Cart</button>
                        </div>
                    </div> -->                    
                </div>
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
        <!-- <div class="flex flex-col">
            <div class="w-full h-[600px] bg-center">
                
            </div>
        </div> -->
    </form>

    <script lang="javascript">
        judulIndex, product_list;
        function load_ajax(){
            judulIndex = document.getElementById("judulIndex");
            product_list = document.getElementById("product_list");
            fetch_product();
        }
        refreshProduct = setInterval(fetch_product, 500);

        function fetch_product(){
            r = new XMLHttpRequest();
            r.onreadystatechange = function(){
                if ((this.readyState==4) && (this.status==200)){
                    product_list.innerHTML = this.responseText;
                }
            }
            r.open("POST", "index_product_fetch.php");
            r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            r.send(`search=<?=$search?>&cate=<?=$cate?>&sorted=<?=$sorted?>&minimum=<?=$minimum?>&maximum=<?=$maximum?>`);
        }

    </script>

</body>
</html>