<?php

spl_autoload_register(function($class){
    include_once ("classes/" . $class . ".class.php");
});

session_start();
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Imgspire</title>
</head>
<body>
    <nav>
        <a href="#">logo</a>
        <a href="#">profile</a>
        <a href="logout.php">logout</a>
    </nav>
    <main>
        
    </main>
</body>
</html>
