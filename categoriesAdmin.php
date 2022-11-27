<?php
    require_once('connection.php');
    if (!isset($_SESSION["data"])){
        header("Location: login.php");
    }

    // Query
    $queryCategory = mysqli_query($conn, "SELECT * from categories");

    // Button
    if(isset($_POST["btnAdd_Category"])){
        $newNama = $_POST["nameCate"];

        if ($newNama != ""){
            $newID = "CA";
            $max = mysqli_query($conn, "SELECT max(substr(id_cate, 3)) from categories");
            $urutan = mysqli_fetch_array($max)[0] + 1;
            $newID .= str_pad(strval($urutan), 3, "0", STR_PAD_LEFT);
    
            mysqli_query($conn, "INSERT INTO categories VALUES('$newID', '$newNama')");
            header("Location: categoriesAdmin.php");
        }else{
            echo "<script>alert('There are empty fields!');</script>";
        }
    }

    if(isset($_POST["btnDelete_Category"])){
        $id_cate = $_POST["btnDelete_Category"];
        mysqli_query($conn, "DELETE FROM categories where id_cate = '$id_cate'");
        header("Location: categoriesAdmin.php");
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
    <title>Categories Admin</title>
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
                <div class="text-4xl px-5 pt-5 pb-6 mb-8 bg-neutral-600 mt-8 mx-12 rounded-[20px] font-semibold text-white">Categories Admin</div>
                <div class="w-48 h-48 rounded-full mx-auto bg-white bg-center" style="background-image: url('assets/userdrrichardlee.png'); background-size: 101%;"></div>
                <div class="bg-neutral-600 w-9/12 h-auto mx-auto rounded-3xl mt-6">
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="homeAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/home.png'); background-size: 90%;"></div>
                        <div class="my-auto ml-5">Home</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="productsAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/productputih.png'); background-size: 100%;"></div>
                        <div class=" my-auto ml-5">Products</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-2xl bg-neutral-800 text-white rounded-full hover:bg-neutral-900 focus:ring-4 active:ring-green-200 focus:outline-none my-4" formaction="#">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/categoryputih.png'); background-size: 80%;"></div>
                        <div class=" my-auto ml-5 font-bold">Categories</div>
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
                <div class="flex bg-gradient-to-r from-purple-900 to-fuchsia-600 p-5 mb-5 shadow-xl">
                    <div class="w-20 h-20 ml-8 mr-2 rounded-full bg-slate-700 text-white text-center bg-[url('assets/Logo.jpg')] bg-cover"></div>
                    <div class="pt-1 pl-7 ml-44 block text-center text-white">
                        <div class="text-xl my-auto font-bold">Admin Glorindo Komputer</div>
                        <div class="text-3xl my-auto font-bold">Welcome Back Admin! Let's Build a Future Together</div>
                    </div>
                </div>
                <div class="overflow-y-auto h-screen -mt-5">
                    <div class="mt-6 max-w-2xl border border-slate-200 rounded-xl mx-auto shadow-md p-5 bg-white">
                        <div class="text-center font-bold text-4xl mb-4 h-14 bg-gradient-to-r from-purple-900 to-purple-600 bg-clip-text text-transparent">Add new Category</div>
                        <div class="flex">
                            <span class="my-auto mr-3 text-lg">Name : </span>
                            <input type="text" name="nameCate" class="px-3 py-2 border w-3/4 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Category">
                        </div>
                        <div class="flex mt-3">
                            <button type="submit" name="btnAdd_Category" class="py-2 px-4 mx-auto rounded-lg text-white font-medium bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800">Add</button>
                        </div>
                    </div>
                    <div class="text-center font-bold text-4xl my-4 h-14 bg-gradient-to-r from-purple-900 to-purple-600 bg-clip-text text-transparent">List Category</div>
                    <div class="grid place-content-center">
                        <table class="table-auto border-separate border-spacing-5 border border-slate-600 text-xl shadow-lg shadow-slate-400 rounded-xl mb-6">
                            <tr>
                                <th class="">ID</th>
                                <th class="">Name</th>
                                <th class="">Action</th>
                            </tr>
                            <?php
                                if($queryCategory->num_rows == 0){
                            ?>
                                <tr>
                                    <td colspan="3" class="text-center">Category is Empty</td> 
                                </tr>
                            <?php
                                }else{
                                    while($row = mysqli_fetch_row($queryCategory)){
                            ?>
                                <tr>
                                    <td class=""><?= $row[0]?></td>
                                    <td class=""><?=$row[1]?></td>
                                    <td class="">
                                        <button class="px-3 py-2 rounded-xl text-white font-semibold bg-red-500 hover:bg-red-600" type="submit" name="btnDelete_Category" value="<?= $row[0]?>">Delete</button>    
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>