<?php
    require_once('connection.php');
    if (!isset($_SESSION["data"])){
        header("Location: login.php");
    }

    // Query

    // Button
    if(isset($_POST["btnAdd_Products"])){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
            { 
                //First, Validate the file name
                if(empty($_FILES['photo']['name']))
                {
                    echo " File name is empty! ";
                    exit;
                }
            
                $upload_file_name = $_FILES['photo']['name'];
            
                //Save the file
                $dest = __DIR__.'/storage/products/'.$upload_file_name;
                $dest2 = 'storage/products/'.$upload_file_name;
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $dest)) 
                {
                    $newID = "CA";
                    $max = mysqli_query($conn, "SELECT max(substr(id_products, 3)) from products");
                    $urutan = mysqli_fetch_array($max)[0] + 1;
                    $newID .= str_pad(strval($urutan), 3, "0", STR_PAD_LEFT);
    
                    mysqli_query($conn, "INSERT INTO color VALUES ('$co_id', '".$_POST["filter_add"]."', '$dest2')");
    
                }
            }
        }
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
                'tampil' : 'muncul 2s ease-in-out 2'
              },
              keyframes : {
                goyang:{
                  '0%, 100%' : {transform: 'rotate(-3deg)'},
                  '50%' :{transform:'rotate(3deg)'}
                },
                muncul:{
                    '0%, 100%' : {
                        opacity: 0
                    },
                    '50%' : {
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
    <form action="" method="POST">
        <div class="flex h-screen">
            <div class="flex-auto w-1/3 bg-neutral-900 flex flex-col text-center">
                <div class="text-4xl px-5 pt-5 pb-6 mb-8 bg-neutral-600 mt-8 mx-12 rounded-[20px] font-semibold text-white">Products Admin</div>
                <div class="w-48 h-48 rounded-full mx-auto bg-white bg-center" style="background-image: url('assets/userdrrichardlee.png'); background-size: 101%;"></div>
                <div class="bg-neutral-600 w-9/12 h-auto mx-auto rounded-3xl mt-6">
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="homeAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/home.png'); background-size: 90%;"></div>
                        <div class="my-auto ml-5">Home</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-2xl bg-neutral-800 text-white rounded-full hover:bg-neutral-900 focus:ring-4 active:ring-green-200 focus:outline-none my-4" formaction="#">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/productputih.png'); background-size: 100%;"></div>
                        <div class=" my-auto ml-5 font-bold">Products</div>
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
                <div class="flex bg-gradient-to-r from-purple-900 to-fuchsia-600 p-5 mb-5 shadow-xl">
                    <div class="w-20 h-20 ml-8 mr-2 rounded-full bg-slate-700 text-white text-center bg-[url('assets/Logo.jpg')] bg-cover"></div>
                    <div class="pt-1 pl-7 ml-44 block text-center text-white">
                        <div class="text-xl my-auto font-bold">Admin Glorindo Komputer</div>
                        <div class="text-3xl my-auto font-bold">Welcome Back Admin! Let's Build a Future Together</div>
                    </div>
                </div>
                <div class="overflow-y-scroll h-screen">
                <div class="max-w-5xl border border-slate-200 rounded-xl mx-auto shadow-md p-5 bg-white">
                        <div class="text-center font-bold text-4xl mb-4 h-14 bg-gradient-to-r from-purple-900 to-purple-600 bg-clip-text text-transparent">Add new Products</div>
                        <div class="pl-8">
                            <span class="my-auto mr-3 text-lg">Name : </span>
                            <input type="text" name="name" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Name Products"><br>
                            <span class="my-auto mr-3 text-lg">Description : </span>
                            <input type="text" name="desc" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Description"><br>
                            <span class="my-auto mr-3 text-lg">Price : </span>
                            <input type="text" name="price" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Price"><br>
                            <span class="my-auto mr-3 text-lg">Stock : </span>
                            <input type="text" name="stok" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Stock"><br>
                            <span class="my-auto mr-3 text-lg">Brand : </span>
                            <input type="text" name="brand" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Brand"><br>
                            <span class="my-auto mr-3 text-lg">Category : </span>
                            <select class="form-select mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" aria-label="Default select example" name="kategoriBarang">
                                <option selected value="">Choose the Category</option>
                            <?php
                                $categoryCB = mysqli_query($conn, "SELECT * from categories");
                                while($row = mysqli_fetch_row($categoryCB)){
                            ?>        
                                <option value="<?=$row[0];?>"> <?= $row[1] ?> </option>
                            <?php
                                }
                            ?>
                            </select><br>
                            <span class="my-auto mr-3 text-lg">Image : </span>
                            <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg,image/webp" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none">
                        </div>
                        <div class="flex mt-3">
                            <button type="submit" name="btnAdd_Products" class="py-2 px-4 mx-auto rounded-lg text-white font-medium bg-gradient-to-r from-purple-600 to-purple-300 hover:bg-gradient-to-r hover:from-purple-800 hover:to-purple-500">Add</button>
                        </div>
                    </div>
                    <div class="text-center font-bold text-4xl my-4 h-14 bg-gradient-to-r from-purple-900 to-purple-600 bg-clip-text text-transparent">List Products</div>
                    <div class="grid place-content-center">
                        <table class="table-auto border-separate text-xl" id="list_categories">
                            <tr>
                                <th class="border">No</th>
                                <th class="border">Name</th>
                                <th class="border">Action</th>
                            </tr>
                            <?php
                                if($queryCategory->num_rows == 0){
                            ?>
                                <tr>
                                    <td colspan="3" class="border text-center">Category is Empty</td> 
                                </tr>
                            <?php
                                }else{
                                    while($row = mysqli_fetch_row($queryCategory)){
                            ?>
                                <tr>
                                    <td class="border"><?= $row[0]?></td>
                                    <td class="border"><?=$row[1]?></td>
                                    <td class="border">
                                        <button class="px-3 py-2 rounded bg-red-500 hover:bg-red-600" type="submit" name="btnDelete_Category" value="<?= $row[0]?>">Delete</button>    
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