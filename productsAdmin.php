<?php
    require_once('connection.php');
    if (!isset($_SESSION["data"])){
        header("Location: login.php");
    }

    // Query
    $queryProducts = mysqli_query($conn, "SELECT p.id_products, p.nama, p.price, c.nama, p.stok from products p JOIN categories c ON c.id_cate = p.id_cate where status = 1 ORDER BY p.id_products");

    // Button
    if(isset($_POST["btnAdd_Products"])){
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $price = $_POST["price"];
        $stok = $_POST["stok"];
        $brand = $_POST["brand"];
        $category = $_POST["categoryCombo"];

        if ($name != "" && $price != "" && $stok != "" && $category != ""){
            if ($stok > 0){
                if ($price > 0){
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
                    {
                        if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
                        { 
                            //First, Validate the file name
                            if(empty($_FILES['photo']['name']))
                            {
                                echo "<script>alert(File name is empty!)</script>";
                                exit;
                            }
                        
                            $upload_file_name = $_FILES['photo']['name'];
                        
                            //Save the file
                            $dest = 'products/'.$upload_file_name;
                            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dest)) 
                            {
                                $newID = "PR";
                                $max = mysqli_query($conn, "SELECT max(substr(id_products, 3)) from products");
                                $urutan = mysqli_fetch_array($max)[0] + 1;
                                $newID .= str_pad(strval($urutan), 4, "0", STR_PAD_LEFT);
                                
                                if ($desc == "")
                                    $desc = "-";
    
                                mysqli_query($conn, "INSERT INTO products VALUES ('$newID', '$name', '$desc', '$price', '$stok', '$brand', '$category', '$dest', 1)");
                                header("Location: productsAdmin.php");
                            }
                        }
                    }
                }else{
                    echo "<script>alert('Price must be greater than 0!');</script>";        
                }
            }else{
                echo "<script>alert('Stock must be greater than 0!');</script>";    
            }
        }else{
            echo "<script>alert('There are empty fields!');</script>";
        }

    }

    if(isset($_POST["btnUpdate_Product"])){
        $idProduct = $_POST["btnUpdate_Product"];
        $resulting = mysqli_query($conn, "SELECT stok FROM products where id_products = '$idProduct'");
        $nambah = mysqli_fetch_row($resulting)[0] + 1;
        mysqli_query($conn, "UPDATE products set stok = '$nambah' where id_products = '$idProduct'");
        header("Location: productsAdmin.php");
    }

    if(isset($_POST["btnDelete_Product"])){
        $idProduct = $_POST["btnDelete_Product"];
        mysqli_query($conn, "UPDATE products set status = 0 where id_products = '$idProduct'");
        header("Location: productsAdmin.php");
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
    <form action="" method="POST" enctype="multipart/form-data">
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
                <div class="overflow-y-scroll h-screen -mt-5">
                <div class="mt-6 max-w-5xl border border-slate-200 rounded-xl mx-auto shadow-md p-5 bg-white">
                        <div class="text-center font-bold text-4xl mb-4 h-14 bg-gradient-to-r from-purple-900 to-purple-600 bg-clip-text text-transparent">Add new Products</div>
                        <div class="pl-8">
                            <span class="my-auto mr-3 text-lg">Name : </span>
                            <input type="text" name="name" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Name Products"><br>
                            <div class="flex">
                                <span class="my-auto mr-3 text-lg">Description : </span>
                                <textarea rows="4" cols="95" name="desc" class="mb-3 mt-2 px-3 py-2 border rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Description"></textarea><br>
                            </div>
                            <span class="my-auto mr-3 text-lg">Price : </span>
                            <input type="text" name="price" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Price"><br>
                            <span class="my-auto mr-3 text-lg">Stock : </span>
                            <input type="text" name="stok" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Stock"><br>
                            <span class="my-auto mr-3 text-lg">Brand : </span>
                            <input type="text" name="brand" class="mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" placeholder="Brand"><br>
                            <span class="my-auto mr-3 text-lg">Category : </span>
                            <select class="form-select mb-3 px-3 py-2 border w-5/6 rounded-lg focus:ring-4 focus:ring-purple-500 focus:outline-none" aria-label="Default select example" name="categoryCombo">
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
                        <table class="table-auto border-separate border-spacing-5 border border-slate-600 text-xl shadow-lg shadow-slate-400 rounded-xl mb-6" id="list_products">
                            <tr>
                                <th class="">No</th>
                                <th class="">ID</th>
                                <th class="">Name</th>
                                <th class="">Price</th>
                                <th class="">Category</th>
                                <th class="">Amount</th>
                                <th class="">Action</th>
                            </tr>
                            <?php
                                if($queryProducts->num_rows == 0){
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center">Product is Empty</td> 
                                </tr>
                            <?php
                                }else{
                                    $ctr = 1;
                                    while($row = mysqli_fetch_row($queryProducts)){
                            ?>
                                <tr>
                                    <td class="text-right"><?= $ctr++?></td>
                                    <td class=""><?= $row[0]?></td>
                                    <td class=""><?=$row[1]?></td>
                                    <td class="">Rp <?=number_format($row[2])?></td>
                                    <td class=""><?=$row[3]?></td>
                                    <td class="text-center"><?=$row[4]?></td>
                                    <td class="">
                                        <button class="px-3 py-2 rounded bg-red-500 hover:bg-red-600" type="submit" name="btnUpdate_Product" value="<?= $row[0]?>">Update</button>
                                        <button class="px-3 py-2 rounded bg-red-500 hover:bg-red-600" type="submit" name="btnDelete_Product" value="<?= $row[0]?>">Delete</button>    
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

    <script lang="javascript">
        
    </script>
</body>
</html>