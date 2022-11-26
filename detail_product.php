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
        <div class="w-2/3 pt-20 mx-auto flex">
            <div class="w-1/3 bg-red-300">
                <img src="https://source.unsplash.com/600x400" alt="">
            </div>
            <div class="w-2/3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora dolor culpa rem vitae amet repudiandae eaque voluptate, explicabo molestias cupiditate nulla est blanditiis expedita, nam sed aliquam eveniet corrupti adipisci magni rerum laboriosam. Ea enim fuga minima a quis perferendis maxime sed hic quas in nihil esse, quo reiciendis architecto tempora error corporis nam veniam earum tempore quasi quod neque quaerat! Aperiam corporis aut nobis illo earum similique ab, harum distinctio sapiente, odit voluptatem quam reprehenderit aspernatur culpa officia vel saepe illum quas, commodi atque fugit nesciunt quo omnis. Alias explicabo nemo quos possimus ab natus ipsam laborum ut tenetur rem laboriosam, quo illo, esse, sequi consequuntur! Nihil sunt dolorum cumque inventore consequuntur blanditiis ducimus maxime quas, magnam aut assumenda, iusto rem eveniet omnis, in quisquam ipsa quos molestias voluptatum tempore quis voluptate voluptas? Magnam, molestiae velit pariatur ad sed voluptatibus ex similique quaerat, quibusdam tempore architecto quis maxime incidunt laudantium quidem dolorum ratione nemo non ab! Sed magnam atque nesciunt reiciendis eaque voluptatum iste error numquam ipsam, architecto quisquam? Dolorum vitae ea magni odit ut qui repellendus corrupti perferendis quidem fugiat fuga placeat, ex ipsum voluptatem amet neque adipisci consequuntur. Eveniet iusto voluptate ipsam delectus modi culpa placeat odit.</div>
        </div>
    </form>
</body>
</html>