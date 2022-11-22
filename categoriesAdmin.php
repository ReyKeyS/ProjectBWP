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
            <div class="flex-auto w-1/3 bg-neutral-900 flex flex-col text-center">
                <h2 class="text-4xl px-5 pt-5 pb-6 mb-8 bg-neutral-600 mt-8 mx-12 rounded-[20px] font-semibold text-white">Categories Admin</h2>
                <div class="w-48 h-48 rounded-full mx-auto bg-white bg-center" style="background-image: url('assets/userdrrichardlee.png'); background-size: 101%;"></div>
                <div class="bg-neutral-600 w-9/12 h-auto mx-auto rounded-3xl mt-6">
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="homeAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/home.png'); background-size: 90%;"></div>
                        <div class=" my-auto ml-3">Home</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="productsAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/productputih.png'); background-size: 100%;"></div>
                        <div class=" my-auto ml-3">Products</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-2xl bg-neutral-800 text-white rounded-full hover:bg-neutral-900 focus:ring-4 active:ring-green-200 focus:outline-none my-4" formaction="#">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/categoryputih.png'); background-size: 80%;"></div>
                        <div class=" my-auto ml-3 font-bold">Categories</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="customerAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/userputih.png'); background-size: 90%;"></div>
                        <div class=" my-auto ml-3">Customers</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="historyAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/history.png'); background-size: 90%;"></div>
                        <div class=" my-auto ml-3">History</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg mt-9 mb-4 rounded-3xl text-white bg-gradient-to-r from-purple-900 to-fuchsia-600 hover:bg-gradient-to-r hover:from-purple-700 hover:to-fuchsia-400 group" name="btnLogout">
                        <div class="w-12 h-12 ml-6 bg-center bg-no-repeat group-hover:scale-110" style="background-image: url('assets/logout.png'); background-size: 80%;"></div>
                        <div class=" my-auto ml-4 text-2xl group-hover:font-bold">Logout</div>
                    </button>
                </div>
            </div>
            <div class="flex-auto flex flex-col w-full bg-blue-600">
                    <div class="flex bg-green-500 p-5 mb-5">
                        <div class="w-20  h-20 rounded-full bg-slate-700 text-white text-center bg-[url('https://source.unsplash.com/600x400')] bg-center"></div>
                        <div class="tulis pt-1 pl-7 ml-5 block">
                            <div class="text-lg my-auto ml-3 pl-28 font-bold">Admin Glorindo Komputer</div>
                            <div class="text-2xl my-auto ml-3 font-bold">Welcome Back Admin ! Let's Build a Future Together</div>
                        </div>
                    </div>
                <div class="overflow-y-auto h-screen">
                    <div class="max-w-lg border border-slate-200 rounded-xl mx-auto shadow-md p-5">
                        <div class="text-center font-semibold text-2xl mb-4">Add new Category</div>
                        <div class="flex">
                            <span class="my-auto mr-3">Name : </span>
                            <input type="text" name="name" class="px-3 py-2 border w-3/4 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Kategori">
                        </div>
                        <div class="flex mt-3">
                            <button type="submit" class="py-2 px-4 mx-auto rounded-lg text-white font-medium bg-gradient-to-r from-purple-600 to-purple-300 hover:bg-gradient-to-r hover:from-purple-800 hover:to-purple-500">Add</button>
                        </div>
                    </div>
                    <div class="text-center font-semibold text-2xl my-4">List Category</div>
                    <div class="grid place-content-center">
                        <table class="table-auto border-collapse border">
                            <tr>
                                <th class="border">No</th>
                                <th class="border">Name</th>
                                <th class="border">Action</th>
                            </tr>
                            <tr>
                                <td class="border">1</td>
                                <td class="border">Mouse</td>
                                <td class="border">
                                    <button type="submit" name="delete" class="px-3 py-2 rounded bg-red-500 hover:bg-red-600">Delete</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>