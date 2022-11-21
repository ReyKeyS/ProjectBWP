<?php
    require_once('connection.php');
    $logged = false;
    if (isset($_SESSION['data'])){
        $logged = true;
    }



    if (isset($_POST["logout"])){
        unset($_SESSION['data']);
        header("Location: index.php");
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
</head>
<body>
    <form action="#" method="POST">
        <?php
            if($logged){
        ?>
                <button submit="submit" name="logout" class="px-3 py-2 border bg-red-500">Logout</button>
        <?php
            }else{
        ?>
                <button submit="submit" formaction="login.php" class="px-3 py-2 border">Login</button>
                <button submit="submit" formaction="register.php" class="px-3 py-2 border">Register</button>
        <?php
            }
        ?>
    </form>
</body>
</html>