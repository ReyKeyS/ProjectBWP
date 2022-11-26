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
        header("Location:cart.php");
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
            <a class="w-32 my-auto ml-3" href="index.php">
                <img src="assets/Logo.jpg" alt="" class="w-12 h-12 mx-auto rounded-full">
            </a>
            <a class="my-auto w-80 text-white font-bold text-2xl" href="index.php">
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
            <div class="w-fit my-auto">
                <button type="submit" name="build" class="px-5 py-2 ml-7 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Build</button>
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
                    <div class="w-32 my-auto">    
                    <button submit="submit" name="logout" class="px-5 py-2 m-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Logout</button>
                </div>
            <?php
                }else{
            ?>
                <div class="w-32 my-auto">
                    <button submit="submit" formaction="login.php" class="px-5 py-2 mx-3 bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Login</button>
                </div>
                <div class="w-32 my-auto">
                    <button submit="submit" formaction="register.php" class="px-5 py-2 m-auto bg-gradient-to-r from-purple-700 to-blue-600 text-white font-semibold rounded-2xl hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Register</button>
                </div>
            <?php
                }
            ?>
        </nav>
        <div class="w-5/6 pt-20 mx-auto mb-5 flex flex-col">
            <div class="ml-10 mb-10 text-4xl font-bold">Build Your PC</div>
            <div class="my-4 flex gap-2">
                <div class="min-w-[80px]">Motherboard</div>
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
                <div class="min-w-[80px]">Processor</div>
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
                <div class="min-w-[80px]">Cooling</div>
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
                <div class="min-w-[80px]">Mouse</div>
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
                <div class="min-w-[80px]">Monitor</div>
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
                <div class="min-w-[80px]">Keyboard</div>
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