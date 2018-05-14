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

if (!empty($_FILES) && isset($_POST['addPost'])) {

    if (!empty($_POST['postDescription']) && !empty($_POST['postImageUrl'])) {

        $file = $currentUser['id'];

        $imageType = pathinfo(basename($_FILES["profile_picture"]["name"]), PATHINFO_EXTENSION);
        $targetFile = "uploads/profile_picture/" . $file . "." . $imageType;

        $postImageUrl = "uploads/posts/".$currentUser['id']. "." .$imageType;

        $postDescription = $_POST['postDescription'];

        try {
            $newPost = new Post();
            $newPost->setPostImageUrl($postImageUrl);
            $newPost->setPostDescription($postDescription);
            $newPost->setUserID($userID);

            $newPost->addPost();
        } catch (Exception $e) {
            $error = $e->getMessage();
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
    <a href="index.php">logo</a>
    <a href="profile.php">profile</a>
    <a href="logout.php">logout</a>
</nav>
<div class="newPost">

    <form class="formPost" action="" method="post" enctype="multipart/form-data">

        <legend>New post</legend>

        <div>
            <label for="postImageUrl">Image</label>
            <input type="file" name="postImageUrl" id="postImageUrl" onchange="readURL(this);" class="form-control">
        </div>

        <div>
            <label for="postDescription">Description</label>
            <textarea required="required" rows="3" type="text" name="postDescription" id="postDescription" class="form-control"><?php echo(isset($_POST['postDescription']) ? $_POST['postDescription'] : ''); ?></textarea>
        </div>

        <input name="addPost" class="addPost" type="submit" value="Save post" id="savePost">



        <?php
        if (isset($error)):?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>


    </form>


</div>
</body>
</html>

