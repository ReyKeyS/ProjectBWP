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
</head>
<body>
    <form action="" method="POST">
        <div class="flex">
            <div class="flex-auto w-1/3 bg-red-500 flex flex-col text-center">
                <h2 class="text-5xl px-5 pt-5 pb-5 mb-5 border">Home ADMIN</h2>
                <div class="w-48 h-48 bg-gray-800 rounded-full mx-auto"></div>
                <button class="flex flex-row border rounded p-5 mt-10" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5"></div>
                    <div class="text-lg my-auto ml-3 font-bold">Home</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5"></div>
                    <div class="text-lg my-auto ml-3">Products</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5"></div>
                    <div class="text-lg my-auto ml-3">Categories</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5"></div>
                    <div class="text-lg my-auto ml-3">Customers</div>
                </button>
                <button class="flex flex-row border rounded p-5" formaction="#">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5"></div>
                    <div class="text-lg my-auto ml-3">History</div>
                </button>
                <button class="flex flex-row border rounded p-5" name="btnLogout">
                    <div class="w-10 h-10 bg-gray-800 rounded-full ml-5"></div>
                    <div class="text-lg my-auto ml-3">Logout</div>
                </button>
            </div>
            <div class="flex-auto w-full bg-blue-600">b</div>
        </div>
    </form>
</body>
</html>