<?php

spl_autoload_register(function($class){
    include_once ("classes/" . $class . ".class.php");
});

session_start();
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
}

$user = new User();
$user->setEmail($_SESSION['user']);
$currentUser = $user->getProfile();
$userEmail = $user->getEmail();
$userFirstName = $user->getFirstName();
$userLastName = $user->getLastName();
$userID = $currentUser['userID'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Welcome to Imgspire</title>
</head>
<body>
    <nav>
        <a href="#">logo</a>
        <a href="profile.php">profile</a>
        <a href="logout.php">logout</a>
    </nav>
    <main>

        <div class="addPost" id="addPost">
            <form action="addPost.php">
                <input type="submit" value="Add new post" />
            </form>

        </div>




    </main>
</body>
</html>
