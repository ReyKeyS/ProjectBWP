<?php
    require_once("connection.php");
    $result=mysqli_query($conn,"SELECT * from users");
    if(isset($_POST['register'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $conf=$_POST['conf'];
        $telp=$_POST['telp'];
        $alamat=$_POST['alamat'];
        $ketemu=false;
        while($row=mysqli_fetch_array($result)){
            if($name==$row['nama'] || $email==$row['email']){
                $ketemu=true;
            }
        }
        if(!$ketemu){
            if($name!="" && $email!="" && $pass!="" && $conf!="" && $telp!="" && $alamat!=""){
                if($pass!=$conf){
                    echo "<script>alert('Password and Confirm Password don't match')</script>";
                }
                else{
                    // GenerateID
                    $newID = "US";
                    $max = mysqli_query($conn, "SELECT max(substr(id_users,3)) from users");
                    $maxUrut = mysqli_fetch_row($max)[0] + 1;
                    $newID .= str_pad($maxUrut, 4, "0", STR_PAD_LEFT);
                    
                    mysqli_query($conn,"INSERT into users values('$newID', '$name', '$email', '$telp', '$alamat', '$pass', '1')");
                    header("Location: login.php");
                }
            }
            else{
                echo "<script>alert('There's an Empty Field')</script>";
            }
        }
        else{
            echo "<script>alert('Name/Email is already used')</script>";
        }
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
    <script>
        tailwind.config = {
          theme: {
            extend: {
              animation:{
                'gerak':'goyang 3s ease-in-out infinite',
                'tampil' : 'muncul 1s ease-in-out 1'
              },
              keyframes : {
                goyang:{
                  '0%, 100%' : {transform: 'rotate(-3deg)'},
                  '50%' :{transform:'rotate(3deg)'}
                },
                muncul:{
                    '0%' : {
                        opacity: 0
                    },
                    '100%':{
                        opacity:1
                    }
                }
              }
            }
          }
        }
      </script>
</head>
<body class="bg-neutral-100">
    <form action="" method="POST">
        <div class="container bg-white box-border py-10 px-20 mx-auto my-20 flex-col top-52 left-52 border rounded-xl place-content-center hover:shadow-lg hover:shadow-cyan-300 duration-300 animate-tampil">
            <h1 class="text-center font-bold text-6xl bg-gradient-to-br from-blue-500 to-red-700 bg-clip-text text-transparent animate-pulse">REGISTER</h1>
            <span class="text-xl">Name</span>
            <input type="text" placeholder="Enter your name" name="name" class="my-2 px-3 py-2 w-full h-14 text-xl border shadow rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
            <span class="text-xl">Email</span>
            <label for="email" id="email">
                <input type="email" placeholder="Enter your email" name="email" class="px-3 py-2 border shadow rounded w-full h-14 text-xl focus:ring-2 focus:ring-blue-400 focus:outline-none invalid:text-purple-600 invalid:focus:ring-purple-600 peer">
                <p class="text-sm text-purple-600 invisible peer-invalid:visible">Email tidak valid</p>
            </label>
            <span class="text-xl">Phone Number</span>
            <input type="number" placeholder="Enter your phone number" name="telp" class="my-2 px-3 py-2 w-full h-14 text-xl border shadow rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
            <span class="text-xl">Address</span>
            <input type="text" placeholder="Enter your address" name="alamat" class="my-2 px-3 py-2 w-full h-14 text-xl border shadow rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
            <span class="text-xl">Password</span>
            <input type="password" placeholder="Enter your password" name="pass" class="my-2 px-3 py-2 border shadow rounded-lg w-full h-14 text-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
            <span class="text-xl">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="conf" class="my-2 px-3 py-2 border shadow rounded-lg w-full h-14 text-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
            <div class="text-center text-xl my-3">Already have an account? &nbsp;<a href="login.php" class="font-semibold text-blue-400 duration-500 hover:text-purple-600 hover:duration-500">Login Now!</a></div>
            <div class="flex">
                <button type="submit" name="register" class="my-5 text-lg font-semibold px-7 py-3 ml-auto text-white rounded-full bg-sky-400 hover:bg-sky-500 active:bg-sky-600 focus:ring-4 focus:ring-sky-200">REGISTER</button>
            </div>
        </div>
    </form>
</body>
</html>