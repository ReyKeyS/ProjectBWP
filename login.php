<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="">
        <div class="container py-10 px-20 mx-auto flex-col fixed top-52 left-52 border rounded-xl place-content-center">
            <h1 class="animate-pulse text-center font-bold text-6xl bg-gradient-to-r from-blue-500 to-red-700 bg-clip-text text-transparent">LOGIN</h1>
            <div class="text-xl">Name</div>
            <input type="text" name="nama" placeholder="Masukkan Nama" class="px-3 py-2 border shadow rounded-lg w-full h-14 text-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <!-- <label for="email" id="email">
                <input type="email" placeholder="Masukkan Email" class="px-3 py-2 border shadow-lg rounded w-full h-14 text-xl focus:ring-2 focus:ring-blue-400 focus:outline-none invalid:text-purple-600 invalid:focus:ring-purple-600 peer">
                <p class="text-sm text-purple-600 invisible peer-invalid:visible">Email tidak valid</p>
            </label> -->
            <div class="text-xl">Password</div>
            <input type="password" name="pass" placeholder="Masukkan Password" class="px-3 py-2 border rounded-xl w-full h-14 text-lg shadow focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <div class="text-xl text-center">Belum punya account? &nbsp;<a href="register.php" class="font-semibold text-blue-400 duration-500 hover:text-purple-600 hover:duration-500">Register Sekarang!</a></div>
            <div class="flex">
                <button type="submit" class="my-5 text-lg font-bold ml-auto px-7 py-3 text-white rounded-full bg-sky-400 hover:bg-sky-500 active:bg-sky-600 focus:ring-4 focus:ring-sky-200">LOGIN</button>
            </div>
        </div>
    </form>
</body>
</html>