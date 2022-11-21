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
                <h2 class="text-5xl px-5 pt-5 pb-5 mb-5 border">Home ADMIN</h2>
                <div class="w-48 h-48 bg-gray-800 rounded-full mx-auto bg-[url('https://source.unsplash.com/600x400')] bg-center">
                </div>
                <button class="flex flex-row border rounded p-5 mt-10" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class="text-lg my-auto ml-3 font-bold">Home</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class="text-lg my-auto ml-3">Products</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class="text-lg my-auto ml-3">Categories</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class="text-lg my-auto ml-3">Customers</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class="text-lg my-auto ml-3">History</div>
                </button>
                <button class="flex flex-row border rounded p-5" name="btnLogout">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5 bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                    <div class="text-lg my-auto ml-3">Logout</div>
                </button>
            </div>
            <div class="flex-auto flex flex-col w-full bg-blue-600">
                <div class="bg-green-500 mb-5">
                    <div class="w-20 h-20 rounded-full bg-slate-700 text-white text-center bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
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