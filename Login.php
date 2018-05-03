<?php
spl_autoload_register(function($class){
    include_once ("classes/" . $class . ".class.php");
});

try{
    if(!empty($_POST)){

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)){
            $user = new User();

            $user->setPassword($_POST['password']);
            $user->setUsername($_POST['username']);

            $user->Login();

        }
        else{
            $error = "Please fill in your credentials";
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
    <title>Login</title>
</head>
<body>
    <h1>Welcome at IMGSPIRE</h1>

    <div class="login">
        <form method="post" class="mainForm">
            <div>
                <label for="username">Username</label>
                <input value="" type="text" class="form form__username" id="username" name="username" placeholder="username">
            </div>

            <div>
                <label for="password">Password</label>
                <input value="" type="password" class="form form__password" id="password" name="password" placeholder="password">
            </div>

            <button class="buttonForm" type="submit">Log in</button>
            <p>Not an account yet? <a href="Register.php">Register here!</a></p>

        </form>

        <?php
        if (isset($error)): ?>

            <div class="error"><?php echo $error ?></div>

        <?php endif; ?>
    </div>
</body>
</html>