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
?>

<!DOCTYPE html>
<html lang="en">
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
                'tampil2': 'hadir 1.5s ease-in-out 1'
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
<body>
    <form action="#" method="POST">
        <nav class="h-20 bg-gradient-to-r from-slate-700 via-slate-500 to-slate-300 flex">
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
                <input type="text" name="search" placeholder="Cari Disini" class="px-5 py-2 rounded-l-xl w-full focus:ring-4 focus:ring-purple-400 focus:outline-none">
                <button name="btnsearch" class="border-l-2 bg-white rounded-r-xl w-12 pl-1 hover:bg-slate-400">
                    <img src="assets/search.png" alt="" class="w-8 h-8 p-1">
                </button>
            </div>
            <div class="w-32 my-auto">
                <button type="submit" name="rakit" class="px-5 py-2 ml-7 bg-gradient-to-r from-purple-700 to-purple-300 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to bg-purple-500">Rakit</button>
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
        <div class="flex flex-col">
            <div class="w-full h-[650px] bg-black" >
                <div class="flex flex-row w-full h-full bg-[center_bottom_-17rem]  animate-tampil2" style="background-image: url('assets/setup.jpg');">
                    <div class="w-1/3 m-auto text-center text-white font-bold text-3xl animate-tampil">
                        Welcome To Our Shop
                        <br>
                        "Bringing the best Quality of Service"
                    </div>
                    <div class="w-2/3"></div>
                </div>
            </div>
            <div class="w-full relative">
                <div class="w-72 px-3 h-80 bg-gradient-to-br from-slate-500 to-slate-900 rounded-t-xl flex flex-col fixed bottom-0 left-0 translate-y-3/4 animate-pulse hover:animate-none hover:translate-y-0 duration-500">
                    <div class="text-white font-semibold text-2xl text-center">Filter</div>
                    <div class="my-1 text-white font-medium">Category</div>
                    <div class="my-1 text-white font-medium">Price</div>
                    <input type="text" name="min" placeholder="Harga minimum" class="px-5 py-2 my-1 w-3/4 mx-auto rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    <input type="text" name="maks" placeholder="Harga maksimum" class="px-5 py-2 my-1 w-3/4 mx-auto rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    <button type="submit" name="apply" class="px-5 py-2 mr-3 ml-auto rounded-xl font-semibold text-white bg-gradient-to-r from-purple-700 to-purple-300 hover:bg-gradient-to-r hover:from-purple-900 hover:to-purple-500">Apply</button>
                    <div class="my-1 text-white font-medium">Sort</div>
                    <div class="flex flex-row">
                        <input type="radio" name="sort" value="asc" class="ml-3">
                        <div class="text-white font-medium">Ascending</div>
                    </div>
                    <div class="flex flex-row">
                        <input type="radio" name="sort" value="desc" class="ml-3">
                        <div class="text-white font-medium">Descending</div>
                    </div>
                </div>
                <div class="text-slate-600 font-bold text-4xl">
                    Recommended
                </div>
                <div class="grid grid-cols-4 mx-auto">
                    <!-- <div class="w-56 h-56 bg-[url('https:/source.unsplash.com/600x400')] bg-center mx-3 rounded-lg"></div> -->
                    <div class="w-96 h-96 shadow-lg overflow-hidden mb-10 mx-auto rounded-lg">
                        <img src="https:/source.unsplash.com/600x400" alt="">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 text-slate-700">Image Title</div>
                            <p class="text-md text-slate-600">Rp 120.000</p>
                            <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-500 to-purple-300 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500">Add to Cart</button>
                        </div>
                    </div>
                    <div class="w-96 h-96 shadow-lg overflow-hidden mb-10 mx-auto rounded-lg">
                        <img src="https:/source.unsplash.com/600x400" alt="">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 text-slate-700">Image Title</div>
                            <p class="text-md text-slate-600">Rp 120.000</p>
                            <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-500 to-purple-300 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500">Add to Cart</button>
                        </div>
                    </div>
                    <div class="w-96 h-96 shadow-lg overflow-hidden mb-10 mx-auto rounded-lg">
                        <img src="https:/source.unsplash.com/600x400" alt="">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 text-slate-700">Image Title</div>
                            <p class="text-md text-slate-600">Rp 120.000</p>
                            <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-500 to-purple-300 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500">Add to Cart</button>
                        </div>
                    </div>
                    <div class="w-96 h-96 shadow-lg overflow-hidden mb-10 mx-auto rounded-lg">
                        <img src="https:/source.unsplash.com/600x400" alt="">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 text-slate-700">Image Title</div>
                            <p class="text-md text-slate-600">Rp 120.000</p>
                            <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-500 to-purple-300 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500">Add to Cart</button>
                        </div>
                    </div>
                    <div class="w-96 h-96 shadow-lg overflow-hidden mb-10 mx-auto rounded-lg">
                        <img src="https:/source.unsplash.com/600x400" alt="">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 text-slate-700">Image Title</div>
                            <p class="text-md text-slate-600">Rp 120.000</p>
                            <button class="px-3 py-2 rounded-xl text-white font-semibold bg-gradient-to-r from-purple-500 to-purple-300 hover:bg-gradient-to-r hover:from-purple-700 hover:to-purple-500">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="flex flex-col">
            <div class="w-full h-[600px] bg-center">
                
            </div>
        </div> -->
    </form>
</body>
</html>