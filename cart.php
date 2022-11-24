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
                <input type="text" name="search" placeholder="Cari Disini" class="px-5 py-2 rounded-l-xl w-full focus:ring-4 focus:ring-purple-400 focus:outline-none">
                <button name="btnsearch" class="border-l-2 bg-white rounded-r-xl w-12 pl-1 hover:bg-slate-400">
                    <img src="assets/search.png" alt="" class="w-8 h-8 p-1">
                </button>
            </div>
            <div class="w-32 my-auto">
                <button type="submit" name="rakit" class="px-5 py-2 ml-7 bg-gradient-to-r from-purple-700 to-purple-300 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to bg-purple-500">Rakit</button>
            </div>
            <button type="submit" name="home" class="flex p-auto m-auto rounded-2xl bg-slate-600 font-semibold text-white hover:bg-slate-900">
                <img src="assets/home.png" alt="" class="w-10 h-10 p-1">
                <span class="my-auto p-1">Home</span>
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
        <div class="pt-20 flex">
            <div class="w-2/3 flex flex-col bg-red-500">
                <div class="text-xl">Your Cart</div>
                <div class="max-w-xl bg-slate-600">a</div>
            </div>
            <div class="w-1/3 bg-green-500"></div>
        </div>
    </form>
</body>
</html>