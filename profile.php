<?php
spl_autoload_register(function($class){
    include_once ("classes/" . $class . ".class.php");
});

session_start();
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
}

$user = new User();
$user->setUsername($_SESSION['user']);
$currentUser = $user->getProfile();
$userID = $currentUser['id'];


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>profile of <?php echo htmlspecialchars($currentUser['username']) ?></title>
</head>
<body>

<nav>
    <a href="#">logo</a>
    <a href="index.php">Home</a>
    <a href="logout.php">logout</a>
</nav>

<h1><?php echo htmlspecialchars($currentUser['username']) ?></h1>

<div class="right">
    <a class="btn btn-default" href="profile_edit.php"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>


</div>

<ul class="data">
    <li><p>Name: <?php echo htmlspecialchars($currentUser['firstname']) ?> <?php echo htmlspecialchars($currentUser['lastname']) ?></p></li>
    <li><p>Posts:</p></li>
</ul>

<h3>About me</h3>
<textarea rows="4" cols="50">

</textarea>
</body>

</html>