<?php
    require_once('connection.php');
    $result=mysqli_query($conn,"SELECT * from users where status=true");
    if(isset($_POST['login'])){
        $nama=$_POST['nama'];
        $pass=$_POST['pass'];
        $ketemu=false;
        $ketemu2=false;
        while($row=mysqli_fetch_array($result)){
            if($nama==$row['email'] || $nama==$row['nama']){
                $ketemu2=true;
                if(md5($pass)==$row['password']){
                    $ketemu=true;
                    $nama=$row['nama'];
                    $email=$row['email'];
                    $telp=$row['telp'];
                    $alamat=$row['alamat'];
                    $baru=[];
                    $baru['nama']=$nama;
                    $baru['email']=$email;
                    $baru['telp']=$telp;
                    $baru['alamat']=$alamat;
                    $baru['pass']=$pass;
                    $_SESSION['data']=$baru;
                    if(isset($_SESSION['page'])){
                        $page=$_SESSION['page'];
                        header("Location:$page.php");
                    }
                    else{
                        header("Location:index.php");
                    }
                }
            }
        }
        if($ketemu2){
            echo "<script>alert('Incorrect Password')</script>";
        }
        else{
            if($nama == "admin" && $pass == "admin"){
                $_SESSION['data']= "admin";
                header("Location: homeAdmin.php");
            }else{
                echo "<script>alert('Incorrect Password')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              animation:{
                'gerak':'goyang 3s ease-in-out infinite',
                'tampil' : 'muncul 1s ease-in-out 1',
                'geserBg':'bgGerak 3s ease infinite'
              },
              keyframes : {
                goyang:{
                  '0%, 100%' : {transform: 'rotate(-3deg)'},
                  '50%' :{transform:'rotate(3deg)'}
                },
                muncul:{
                    '0%' : {
                        opacity: 0,
                        transform:'translateX(-5%)'
                    },
                    '100%':{
                        opacity:1,
                        transform:'translateX(0%)'
                    }
                },
                bgGerak:{
                    '0%,100%':{
                        'background-size':'200% 200%',
                        'background-position':'left center',
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
<body class="bg-gradient-to-r from-purple-700 via-red-300 to-blue-600 animate-geserBg">
    <form action="" method="POST">
        <div class="w-screen h-screen flex justify-center animate-tampil">
            <div class="bg-white py-5 px-16 sm:py-10 sm:px-20 w-full sm:w-1/2 m-auto flex flex-col border rounded-xl place-content-center hover:shadow-cyan-300 hover:shadow-xl duration-300">
                <h1 class="animate-pulse text-center font-bold text-6xl bg-gradient-to-r from-blue-500 to-red-700 bg-clip-text text-transparent">LOGIN</h1>
                <div class="text-xl mb-1">Name/Email</div>
                <input type="text" name="nama" placeholder="Enter your name/email" class="mb-3 px-3 py-2 border shadow rounded-lg w-full h-14 text-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <!-- <div class="text-xl">Email</div> -->
                <!-- <label for="email" id="email">
                    <input type="email" placeholder="Masukkan Email" class="px-3 py-2 border shadow rounded-xl w-full h-14 text-xl focus:ring-2 focus:ring-blue-400 focus:outline-none invalid:text-purple-600 invalid:focus:ring-purple-600 peer">
                    <p class="text-sm text-purple-600 invisible peer-invalid:visible">Email tidak valid</p>
                </label> -->
                <div class="text-xl mb-1">Password</div>
                <input type="password" name="pass" placeholder="Enter your password" class="px-3 py-2 border rounded-xl w-full h-14 text-xl shadow focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <div class="text-xl text-center mt-3">Doesn't have an account? &nbsp;<a href="register.php" class="font-semibold text-blue-400 duration-500 hover:text-purple-600 hover:duration-500">Register Now!</a></div>
                <div class="flex">
                    <button type="submit" name="home" formaction="index.php" class="my-5 text-lg font-bold mr-auto px-7 py-3 flex text-white rounded-full bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800 active:bg-sky-600 focus:ring-4 focus:ring-purple-800">
                        <img src="assets/home.png" alt="" class="w-5 h-5 my-auto mr-5">
                        HOME
                    </button>
                    <button type="submit" name="login" class="my-5 text-lg font-bold ml-auto px-7 py-3 text-white rounded-full bg-gradient-to-r from-purple-700 to-blue-600 hover:bg-gradient-to-r hover:from-purple-900 hover:to-blue-800 active:bg-sky-600 focus:ring-4 focus:ring-sky-200">LOGIN</button>
                </div>
            </div>

        </div>
    </form>
</body>
</html>