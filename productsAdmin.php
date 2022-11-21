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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .tmbl{
            width: 360px;
            height: 80px;
            margin-left: 50px;
            font-size: 18pt;
            background-color: green;
            border-radius: 70px;
        }
        .bkntmbl{
            width: 360px;
            height: 80px;
            margin-left: 50px;
            font-size: 18pt;
            border-radius: 70px;
        }
        .contain{
            display: flex;
        }
        .atur{
            font-size: 20pt;
        }
        .atur1{
            font-size: 17pt;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          darkMode:'class',
          theme: {
            extend: {
              animation:{
                'gerak':'goyang 3s ease-in-out infinite'
              },
              keyframes : {
                goyang:{
                  '0%, 100%' : {transform: 'rotate(-3deg)'},
                  '50%' :{transform:'rotate(3deg)'}
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
            <div class="flex-auto w-1/3 bg-red-500 flex flex-col text-center">
                <h2 class="text-5xl px-5 pt-5 pb-5 mb-5 border">Home Admin</h2>
                <div class="w-48 h-48 bg-gray-800 rounded-full mx-auto bg-[url('https://source.unsplash.com/600x400')] bg-center">
                </div>
                <button class="flex flex-row bkntmbl p-5 mt-10" formaction="homeAdmin.php">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class=" my-auto ml-3">Home</div>
                </button>
                <button class="flex flex-row tmbl p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class=" my-auto ml-3 font-bold">Products</div>
                </button>
                <button class="flex flex-row bkntmbl p-5" formaction="categoriesAdmin.php">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class=" my-auto ml-3">Categories</div>
                </button>
                <button class="flex flex-row bkntmbl p-5" formaction="customersAdmin">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class=" my-auto ml-3">Customers</div>
                </button>
                <button class="flex flex-row bkntmbl p-5" formaction="historyAdmin">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class=" my-auto ml-3">History</div>
                </button>
                <button class="flex flex-row bkntmbl p-5" name="btnLogout">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class=" my-auto ml-3">Logout</div>
                </button>
            </div>
            <div class="flex-auto flex flex-col w-full bg-blue-600">
                    <div class="contain bg-green-500 p-5 mb-5">
                        <div class="w-20  h-20 rounded-full bg-slate-700 text-white text-center bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                        <div class="tulis pt-1 pl-7 ml-5 block">
                            <div class="atur my-auto ml-3 font-bold"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Admin Glorindo Komputer</div>
                            <div class="atur1 my-auto ml-3 font-bold">Welcome Back Admin ! Let's Build a Future Together</div>
                        </div>
                    </div>
                <div class="overflow-y-scroll h-screen">
                    <div class="mx-auto px-6 bg-purple-600 columns-4">
                        <div class="rounded-md shadow-lg overflow-hidden bg-slate-500">
                            <img src="https://source.unsplash.com/600x400" alt="" class="w-full">
                            <div class="px-6 py-4">
                                1000 Customer
                            </div>
                        </div>
                        <div class="rounded-md shadow-lg overflow-hidden bg-slate-500">
                            <img src="https://source.unsplash.com/600x400" alt="" class="w-full">
                            <div class="px-6 py-4">
                                2000 Products
                            </div>
                        </div>
                        <div class="rounded-md shadow-lg overflow-hidden bg-slate-500">
                            <img src="https://source.unsplash.com/600x400" alt="" class="w-full">
                            <div class="px-6 py-4">
                                10 Category
                            </div>
                        </div>
                        <div class="rounded-md shadow-lg overflow-hidden bg-slate-500">
                            <img src="https://source.unsplash.com/600x400" alt="" class="w-full">
                            <div class="px-6 py-4">
                                3000 Transaction
                            </div>
                        </div>
                    </div>
                    <div class="mt-20">
                        <img src="https://source.unsplash.com/600x400" alt="" class="mx-auto animate-gerak">
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>