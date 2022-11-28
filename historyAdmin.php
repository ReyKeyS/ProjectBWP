<?php
    require_once('connection.php');
    if (!isset($_SESSION["data"])){
        header("Location: login.php");
    }

    if(isset($_POST["btnLogout"])){
        unset($_SESSION["data"]);
        header("Location: index.php");
    }
    $isihtrans=mysqli_query($conn,"SELECT * from htrans order by id_htrans desc");
    
    if (isset($_POST["btnAccept"])){
        $idHtrans = $_POST["btnAccept"];
        $queryCurDTrans = mysqli_query($conn, "SELECT * from dtrans where id_htrans = '$idHtrans'");
        $berhasil = true;
        while($row = mysqli_fetch_array($queryCurDTrans)){
            $queryP = mysqli_query($conn, "SELECT * from products where status = 1 and id_products = '".$row["id_products"]."'");
            $prod = mysqli_fetch_array($queryP);
            if ($row["qty"] > $prod["stok"]){
                $berhasil = false;
                break;
            }
        }
        if ($berhasil){
            echo "<script>alert('".$idHtrans."');</script>";
            mysqli_query($conn, "UPDATE htrans set status = 0 where id_htrans = '$idHtrans'");
            // Kurangi Stok
            $queryCurDTrans = mysqli_query($conn, "SELECT * from dtrans where id_htrans = '$idHtrans'");
            while($row = mysqli_fetch_array($queryCurDTrans)){
                $queryP = mysqli_query($conn, "SELECT stok from products where status = 1 and id_products = '".$row["id_products"]."'");
                $hasilKurang = mysqli_fetch_row($queryP)[0] - $row["qty"];
                mysqli_query($conn, "UPDATE products set stok = $hasilKurang where id_products = '".$row["id_products"]."'");                
            }
        }else{
            echo "<script>alert('Stock is empty / not enough!');</script>";
        }
        
        header("Location: historyAdmin.php");
    }

    if (isset($_POST["btnDecline"])){
        $idHtrans = $_POST["btnDecline"];
        mysqli_query($conn, "UPDATE htrans set status = 2 where id_htrans = '$idHtrans'");
        header("Location: historyAdmin.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
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
                <div class="text-4xl px-5 pt-5 pb-6 mb-8 bg-neutral-600 mt-8 mx-12 rounded-[20px] font-semibold text-white">History Admin</div>
                <div class="w-48 h-48 rounded-full mx-auto bg-white bg-center" style="background-image: url('assets/rykflex.png'); background-size: 101%;"></div>
                <div class="bg-neutral-600 w-9/12 h-auto mx-auto rounded-3xl mt-6">
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg my-4 rounded-full text-white hover:bg-neutral-900 hover:text-white" formaction="homeAdmin.php">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/home.png'); background-size: 90%;"></div>
                        <div class="my-auto ml-5">Home</div>
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
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-2xl bg-neutral-800 text-white rounded-full hover:bg-neutral-900 focus:ring-4 active:ring-green-200 focus:outline-none my-4" formaction="#">
                        <div class="w-12 h-12 ml-5 bg-center bg-no-repeat" style="background-image: url('assets/history.png'); background-size: 90%;"></div>
                        <div class=" my-auto ml-5 font-bold">History</div>
                    </button>
                    <button class="flex flex-row px-6 py-3 w-5/6 mx-auto text-lg mt-9 mb-4 rounded-3xl text-white bg-gradient-to-r from-purple-900 to-fuchsia-600 hover:bg-gradient-to-r hover:from-purple-700 hover:to-fuchsia-400 group" name="btnLogout">
                        <div class="w-12 h-12 ml-6 bg-center bg-no-repeat group-hover:scale-110" style="background-image: url('assets/logout.png'); background-size: 80%;"></div>
                        <div class=" my-auto ml-4 text-2xl group-hover:font-bold">Logout</div>
                    </button>
                </div>
            </div>
            <div class="flex-auto flex flex-col w-full">
                <div class="flex bg-gradient-to-r from-purple-900 via-fuchsia-600 to-blue-600 p-5 mb-5 shadow-xl animate-geserBg">
                    <div class="w-20 h-20 ml-8 mr-2 rounded-full bg-slate-700 text-white text-center bg-[url('assets/Logo.jpg')] bg-cover"></div>
                    <div class="pt-1 pl-7 ml-44 block text-center text-white">
                        <div class="text-xl my-auto font-bold">Admin Glorindo Komputer</div>
                        <div class="text-3xl my-auto font-bold">Welcome Back Admin! Let's Build a Future Together</div>
                    </div>
                </div>
                <div class="overflow-y-auto h-screen">
                    <!-- <div class="mx-auto px-6 bg-purple-600 columns-4">
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
                    </div> -->
                    <div class="w-full mx-auto flex flex-col">
                        <?php
                            while($row2=mysqli_fetch_array($isihtrans)){
                            
                        ?>
                        <div class="w-1/2 mx-auto my-2 p-3 rounded-xl shadow-xl flex flex-col border">
                            <div class="text-lg flex w-full">
                                <a class="text-slate-400">
                                    <?= $row2['invoice']?>
                                </a>
                                <a class="ml-auto">
                                <?php
                                    if ($row2["status"]=="1"){
                                ?>
                                    <a class="text-2xl text-yellow-500 font-semibold">Pending ⌛</a>
                                <?php
                                    }else if ($row2["status"]=="0"){
                                ?>
                                    <a class="text-2xl text-green-400 font-semibold">Done ✔ </a>
                                <?php
                                    }else if ($row2["status"]=="2"){
                                ?>
                                    <a class="text-2xl text-red-400 font-bold">Failed❌</a>
                                <?php
                                    }
                                ?>
                                </a>
                            </div>
                            <div class="mb-2"><?=substr($row2["tanggal"], 0, 10)?> | <?=substr($row2["tanggal"], 11)?></div>
                            <?php
                                $id=$row2['id_htrans'];
                                $isidtrans=mysqli_query($conn,"SELECT p.nama, dt.qty, p.price, p.gmbr from dtrans dt join products p on p.id_products = dt.id_products where id_htrans='$id'");
                                $totalSubtotal = 0;
                                while($row=mysqli_fetch_array($isidtrans)){
                            ?>
                            <div class="flex my-1">
                                <div class="w-1/4">
                                    <img src="<?=$row[3]?>" alt="" class="w-20 h-20 mx-auto">
                                </div>
                                <div class="w-2/4 flex flex-col">
                                    <div class="text-2xl font-semibold"><?= $row[0]?></div>
                                    <div class="text-base text-slate-600"><?= $row[1]?> x Rp <?= number_format($row[2])?></div>
                                </div>
                                <div class="w-1/4 flex flex-col">
                                    <div class="text-base">Subtotal</div>
                                    <div class="text-xl font-bold">Rp <?= number_format($row[1]*$row[2])?></div>
                                    <?php $totalSubtotal += ($row[1]*$row[2]); ?>
                                </div>
                            </div>
                            <?php
                                }
                                $queryUserBeli = mysqli_query($conn, "SELECT * from users where id_users = '".$row2["id_users"]."'");
                                $dataUserBeli = mysqli_fetch_array($queryUserBeli);
                            ?>
                            <div class="ml-auto mr-16 font-bold text-2xl flex flex-col">
                                <a class="font-semibold">Total Price</a>
                                <a>Rp <?=number_format($totalSubtotal)?></a>
                            </div>
                            <div><?=$dataUserBeli["nama"]?></div>
                            <div><?=$dataUserBeli["telp"]?></div>
                            <div><?=$dataUserBeli["alamat"]?></div>
                            <div class="text-lg font-semibold">Build Service : Rp <?php if ($row2["dirakit"] == 0) echo "0"; else echo "120,000"; ?></div>
                            <div class="flex">
                                <div class="text-2xl font-bold">
                                    Grand Total : Rp <?=number_format($row2["total"])?>
                                </div>
                                <div class="flex ml-auto gap-1">
                                    <?php
                                        if($row2["status"]=="1"){
                                    ?>
                                    <button type="submit" name="btnAccept" value="<?=$row2["id_htrans"]?>" class="px-5 py-3 text-white font-semibold bg-green-500 rounded-xl hover:bg-green-600">Accept</button>
                                    <button type="button" data-modal-toggle="defaultModal<?=$row2["id_htrans"]?>" value="<?=$row2["id_htrans"]?>" class="px-5 py-3 text-white font-semibold bg-red-500 rounded-xl hover:bg-red-600">Decline</button>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="defaultModal<?=$row2["id_htrans"]?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                            <div class="relative w-full max-w-2xl h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex justify-between items-start p-4 rounded-t border-b">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Cancel Transaction
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal<?=$row2["id_htrans"]?>">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500">
                                            Are you sure you want to cancel the transaction?
                                        </p>
                                        <p class="text-base leading-relaxed text-gray-500">
                                            
                                        </p>
                                    </div>
                                    <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                        <button data-modal-toggle="defaultModal<?=$row2["id_htrans"]?>" type="submit" name="btnDecline" value="<?=$row2["id_htrans"]?>" class="text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Yes</button>
                                        <button data-modal-toggle="defaultModal<?=$row2["id_htrans"]?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal toggle -->

<!-- Main modal -->
<!-- <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-2xl h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex justify-between items-start p-4 rounded-t border-b">
                <h3 class="text-xl font-semibold text-gray-900">
                    Cancel Transaction
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <p class="text-base leading-relaxed text-gray-500">
                    Are you sure you want to cancel the transaction?
                </p>
                <p class="text-base leading-relaxed text-gray-500">
                    
                </p>
            </div>
            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                <button data-modal-toggle="defaultModal" type="submit" name="btnDecline" class="text-white bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Yes</button>
                <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No</button>
            </div>
        </div>
    </div>
</div> -->
    </form>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>