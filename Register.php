<?php

spl_autoload_register(function($class){
    include_once ("classes/" . $class . ".class.php");
});

try{


if (!empty($_POST)){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['confirmPass'];

if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($username) && !empty($password) && !empty($passwordConfirm) && $password == $passwordConfirm){
    $user = new User();

    $user->setFirstname($_POST['firstname']);
    $user->setLastname($_POST['lastname']);
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

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Register</title>
</head>
<body>
    <div class="register">
    <form class="mainForm" action="" method="post">

        <div>
            <label for="firstname">Firstname</label>
            <input value="" type="text" class="form form__firstname" id="firstname" name="firstname" placeholder="firstname">
        </div>

        <div>
            <label for="lastname">Lastname</label>
            <input value="" type="text" class="form form__lastname" id="lastname" name="lastname" placeholder="lastname">
        </div>

        <div>
            <label for="username">Username</label>
            <input value="" type="text" class="form form__username" id="username" name="username" placeholder="username">
        </div>

        <div>
            <label for="email">Email</label>
            <input value="" type="email" class="form form__email" id="email" name="email" placeholder="email">
        </div>

        <div>
            <label for="password">password</label>
            <input value="" type="password" class="form form__password" id="password" name="password" placeholder="password">
        </div>

        <div>
            <label for="confirmPass">Confirm password</label>
            <input value="" type="password" class="form form__confirmPass" id="confirmPass" name="confirmPass" placeholder="confirm password">
        </div>

        <button class="buttonReg" type="submit">Sign Up</button>

        <p>Already have an account? <a href="login.php">Login here!</a></p>
    </form>

    <?php
    if (isset($error)): ?>

        <div class="error"><?php echo $error ?></div>

    <?php endif; ?>
    </div>
</body>
</html>