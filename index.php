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
        <div class="container mx-auto flex-col fixed top-52 left-52 border rounded-xl place-content-center">
            <h1 class="text-center font-bold text-6xl bg-gradient-to-r from-blue-500 to-teal-300 bg-clip-text text-transparent">LOGIN</h1>
            <span>Email</span>
            <label for="email" id="email">
                <input type="email" placeholder="masukkan email" class="px-3 py-2 border shadow-lg rounded w-full text-sm focus:ring-2 focus:ring-green-400 focus:outline-none invalid:text-purple-600 invalid:focus:ring-purple-600 peer">
                <p class="text-sm text-purple-600 invisible peer-invalid:visible">Email tidak valid</p>
            </label>
        </div>
    </form>
</body>
</html>