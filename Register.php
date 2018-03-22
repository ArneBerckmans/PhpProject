<?php

spl_autoload_register(function($class){
        include_once ("classes/" . $class . ".class.php");
    });

try{


if (!empty($_POST)){

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['confirmPass'];

if(!empty($email) && !empty($username) && !empty($password) && !empty($passwordConfirm) && $password == $passwordConfirm){
    $user = new User();

    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setUsername($_POST['username']);

    $user->register();



}
else if($password != $passwordConfirm){
    $error = "Passwords do not match.";
}
else{
    $error = "please fill in the credentials.";
}

}
}
catch(Exception $e){
    $error = $e->getMessage();
}



?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form class="" action="" method="post">
        <div>
            <label for="username">Username</label>
            <input value="" type="text" id="username" name="username">
        </div>

        <div>
            <label for="email">Email</label>
            <input value="" type="email" id="email" name="email">
        </div>

        <div>
            <label for="password">password</label>
            <input value="" type="password" id="password" name="password">
        </div>

        <div>
            <label for="confirmPass">Confirm password</label>
            <input value="" type="password" id="confirmPass" name="confirmPass">
        </div>

        <button class="buttonReg" type="submit">Sign Up</button>

    </form>

    <?php
    if (isset($error)): ?>

        <div class="error"><?php echo $error ?></div>

    <?php endif; ?>

</body>
</html>