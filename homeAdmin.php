<?php
    require_once('connection.php');
    if (!isset($_SESSION["data"])){
        header("Location: login.php");
    }

    if(isset($_POST["btnLogout"])){
        unset($_SESSION["data"]);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              animation:{
                'gerak':'goyang 3s ease-in-out infinite',
                'geserBg':'bgGerak 3s ease infinite'
              },
              keyframes : {
                goyang:{
                  '0%, 100%' : {transform: 'rotate(-3deg)'},
                  '50%' :{transform:'rotate(3deg)'}
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
</head>
<body>
    <form action="" method="POST">
        <div class="flex h-screen">
            <div class="flex-auto w-1/3 bg-neutral-900 flex flex-col text-center">
                <div class="text-4xl px-5 pt-5 pb-6 mb-8 bg-neutral-600 mt-8 mx-12 rounded-[20px] font-semibold text-white">Home Admin</div>
                <div class="w-48 h-48 rounded-full mx-auto bg-white bg-center" style="background-image: url('assets/userdrrichardlee.png'); background-size: 101%;"></div>
                <div class="bg-neutral-600 w-9/12 h-auto mx-auto rounded-3xl mt-6">
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-2xl bg-neutral-800 text-white rounded-full hover:bg-neutral-900 focus:ring-4 active:ring-green-200 focus:outline-none my-4" formaction="#">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/home.png'); background-size: 90%;"></div>
                        <div class="my-auto ml-5 font-bold">Home</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="productsAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/productputih.png'); background-size: 100%;"></div>
                        <div class=" my-auto ml-5">Products</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="categoriesAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/categoryputih.png'); background-size: 80%;"></div>
                        <div class=" my-auto ml-5">Categories</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="customerAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/userputih.png'); background-size: 90%;"></div>
                        <div class=" my-auto ml-5">Customers</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="historyAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/history.png'); background-size: 90%;"></div>
                        <div class=" my-auto ml-5">History</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg mt-9 mb-4 rounded-3xl text-white bg-gradient-to-r from-purple-900 to-fuchsia-600 hover:bg-gradient-to-r hover:from-purple-700 hover:to-fuchsia-400 group" name="btnLogout">
                        <div class="w-12 h-12 ml-6 bg-center bg-no-repeat group-hover:scale-110" style="background-image: url('assets/logout.png'); background-size: 80%;"></div>
                        <div class=" my-auto ml-4 text-2xl group-hover:font-bold">Logout</div>
                    </button>
                </div>
            </div>
            <div class="flex-auto flex flex-col w-full bg-neutral-100">
                <div class="flex bg-gradient-to-r from-purple-900 via-fuchsia-600 to-blue-600 p-5 mb-5 shadow-xl animate-geserBg">
                    <div class="w-20 h-20 ml-8 mr-2 rounded-full bg-slate-700 text-white text-center bg-[url('assets/Logo.jpg')] bg-cover"></div>
                    <div class="pt-1 pl-7 ml-44 block text-center text-white">
                        <div class="text-xl my-auto font-bold">Admin Glorindo Komputer</div>
                        <div class="text-3xl my-auto font-bold">Welcome Back Admin! Let's Build a Future Together</div>
                    </div>
                </div>
                <div class="overflow-y-auto h-screen -mt-5">
                    <div class="my-6 text-center font-bold text-5xl bg-gradient-to-r from-purple-900 to-fuchsia-600 bg-clip-text text-transparent">Dashboard</div>
                    <div class="mx-auto px-6 columns-4 mt-8">
                        <div class="rounded-xl border border-gray-400 shadow-lg overflow-hidden pt-8 px-8 bg-white">
                            <a href="customerAdmin.php">
                                <img src="assets/customer.png" alt="" class="w-[75px] ml-5">
                                <div class="my-3 font-bold text-gray-500 text-3xl ml-3">Customers</div>
                                <div class="w-full h-2 rounded-full bg-gradient-to-r from-purple-900 to-fuchsia-600"></div>
                                <div class="text-center py-4 font-bold text-5xl">
                                    <?php
                                        $queryCustomer = mysqli_query($conn, "SELECT count(*) from users where status = 1");
                                        $banyakCustomer = mysqli_fetch_row($queryCustomer)[0];
                                        echo $banyakCustomer;
                                    ?>
                                </div>
                            </a>
                        </div>
                        <div class="rounded-xl border border-gray-400 shadow-lg overflow-hidden pt-8 px-8 bg-white">
                            <a href="productsAdmin.php">
                                <img src="assets/productsabu.png" alt="" class="w-[80px] ml-5">
                                <div class="my-3 font-bold text-gray-500 text-3xl ml-3">Products</div>
                                <div class="w-full h-2 rounded-full bg-gradient-to-r from-purple-900 to-fuchsia-600"></div>
                                <div class="text-center py-4 font-bold text-5xl">
                                    <?php
                                        $queryProduct = mysqli_query($conn, "SELECT count(*) from products where status = 1");
                                        $banyakProduct = mysqli_fetch_row($queryProduct)[0];
                                        echo $banyakProduct;
                                    ?>
                                </div>
                            </a>
                        </div>
                        <div class="rounded-xl border border-gray-400 shadow-lg overflow-hidden pt-8 px-8 bg-white">
                            <a href="categoriesAdmin.php">
                                <img src="assets/cateogoryabu.png" alt="" class="w-[75px] ml-5">
                                <div class="my-3 font-bold text-gray-500 text-3xl ml-3">Categories</div>
                                <div class="w-full h-2 rounded-full bg-gradient-to-r from-purple-900 to-fuchsia-600"></div>
                                <div class="text-center py-4 font-bold text-5xl">
                                    <?php
                                        $queryCategory = mysqli_query($conn, "SELECT count(*) from categories");
                                        $banyakCate = mysqli_fetch_row($queryCategory)[0];
                                        echo $banyakCate;
                                    ?>
                                </div>
                            </a>
                        </div>
                        <div class="rounded-xl border border-gray-400 shadow-lg overflow-hidden pt-8 px-8 bg-white">
                            <a href="historyAdmin.php">
                                <img src="assets/transactionabu.png" alt="" class="w-[75px] ml-5">
                                <div class="my-3 font-bold text-gray-500 text-3xl ml-3">Transactions</div>
                                <div class="w-full h-2 rounded-full bg-gradient-to-r from-purple-900 to-fuchsia-600"></div>
                                <div class="text-center py-4 font-bold text-5xl">
                                    <?php
                                        $queryCategory = mysqli_query($conn, "SELECT count(*) from htrans");
                                        $banyakCate = mysqli_fetch_row($queryCategory)[0];
                                        echo $banyakCate;
                                    ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="my-7 text-center font-bold text-5xl bg-gradient-to-r from-purple-900 to-fuchsia-600 bg-clip-text text-transparent">Promo Deals</div>
                    <div class="mb-14 mt-10">
                        <img src="assets/ElectronicDeals.png" alt="" class="mx-auto animate-gerak">
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>