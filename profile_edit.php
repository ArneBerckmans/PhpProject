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


if(!empty($_POST)){
    if(isset($_POST['editProfile'])) {

        $newEmail = $_POST['email'];
        $newPassword = $_POST['password'];
        $newFirstName = $_POST['firstname'];
        $newLastName = $_POST['lastname'];
        $newUserName = $_POST['username'];


        try{
            $oldEmail = $currentUser['email'];
            $updatedUser = new User();
            $updatedUser->setEmail($newEmail);
            $updatedUser->setfirstName($newFirstName);
            $updatedUser->setLastName($newLastName);
            $updatedUser->setUsername($newUserName);

            if (!empty($_POST['password'])) {
                $updatedUser->setPassword($newPassword);
            }else{
                $e = "nonde";

            }

            if ($updatedUser->updateProfile($oldEmail)) {
                $_SESSION['user'] = $newEmail;
                $currentUser = $user->getProfile();
                $feedback = "Saved";
                $_SESSION["user"] = $updatedUser->getEmail();
                header('location: profile_edit.php?saved');
            }else{
                $e = "nonde";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

    if (!empty($_FILES) && isset($_POST['addPicture'])) {
        $file = $currentUser['id'];

        $imageType = pathinfo(basename($_FILES["profile_picture"]["name"]), PATHINFO_EXTENSION);
        $targetFile = "uploads/profile_picture/" . $file . "." . $imageType;

        try{
            if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                throw new Exception('This is not an image');
            }

            $imageUrl = "uploads/profile_picture/".$currentUser['id']. "." .$imageType;
            try {
                $user2 = new User();
                $user2->setEmail($currentUser['email']);
                $user2->setImageUrl($imageUrl);
                if ($user2->changePicture()) {
                    $currentUser = $user->getProfile();
                    $feedback2 = "Saved";
                }
            } catch (Exception $e) {
                $error2 = $e->getMessage();
            }
        } catch (Exception $e) {
            $error2 = $e->getMessage();
        }
    }

}


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Document</title>
</head>
<body>

<nav>
    <a href="#">logo</a>
    <a href="index.php">Home</a>
    <a href="logout.php">logout</a>
</nav>

    <div>
        <form class="editProfile" action="" method="post">
            <legend>Edit profile</legend>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($currentUser['email']); ?>">
            </div>
            <div>
                <label for="username">Username</label>
                <input type="username" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($currentUser['username']); ?>">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div>
                <label for="firstname">Firstname</label>
                <input type="firstname" name="firstname" id="firstname" class="form-control" value="<?php echo htmlspecialchars($currentUser['firstname']); ?>">
            </div>
            <div>
                <label for="lastname">Lastname</label>
                <input type="lastname" name="lastname" id="lastname" class="form-control" value="<?php echo htmlspecialchars($currentUser['lastname']); ?>">
            </div>


            <input name="editProfile" class="btn btn-lg btn-primary btn-block" type="submit" value="Save changes">
            <p>OR</p>
            <a href="profile.php">Back</a>

            <?php
            if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php
            if (isset($feedback)): ?>
                <div class="alert alert-success"><?php echo $feedback; ?></div>
            <?php endif; ?>
        </form>
    </div>

    <div>
        <form class="addPicture" action="" method="post" enctype="multipart/form-data">
            <legend>Edit profile picture</legend>
                <div class="profilepic" style="background: url('<?php echo $currentUser["imageUrl"] ?>')  center;background-size: cover;">
                    <div>
                        <label for="profilePicture">Image</label>
                        <input type="file" name="profile_picture" id="profile_picture" onchange="readURL(this);" class="form-control">
                    </div>

                    <input name="addPicture" class="btn btn-lg btn-primary btn-block" type="submit" value="Save changes">
                </div>
        </form>
    </div>

</body>
</html>