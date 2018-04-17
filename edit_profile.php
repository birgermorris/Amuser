<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once("classes/User.class.php");

$user = new User();
$user->setUser_id($_SESSION["user_id"]);
$profile = $user->getUserInfo();

if(!empty($_POST["edit"])) {
    //Image upload
    //var_dump($_FILES['profileImg'][0]);

    if(!empty($_FILES['profileImg']['name'])) {
        $saveImage = new User();
        $nameWithoutSpace = preg_replace('/\s+/','',$_FILES['profileImg']['name']);
        $nameWithoutSpaceTMP = preg_replace('/\s+/','',$_FILES['profileImg']['tmp_name']);
        $nameWithoutSpaceSize = preg_replace('/\s+/','',$_FILES['profileImg']['size']);
        $saveImage->SetImageName($nameWithoutSpace);
        $saveImage->SetImageSize($nameWithoutSpaceSize);
        $saveImage->SetImageTmpName($nameWithoutSpaceTMP);
        $destination = $saveImage->SaveProfileImg();
    }

    $user_edit = new User();
    $user_edit->setUser_id($_SESSION["user_id"]);
    $user_edit->setFirstname($_POST["firstname"]);
    $user_edit->setLastname($_POST["lastname"]);
    $user_edit->setEmail($_POST["email"]);
    $user_edit->setBio($_POST["bio"]);
    $user_edit->setImage($destination);
    if($user_edit->update()){
        $message = "Your profile is updated.";
    } else {
        $error = "Something went wrong, profile isn't updated.";
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!-- HIER MOET INCLUDE HEADER ENZO KOMEN -->
<?php include_once("includes/header.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>

<h2>Edit profile</h2>
    <form method="post" action="" enctype="multipart/form-data">

    <label for="profileImg">Mijn profielfoto</label>
    <img src="<?php echo $profile['image'] ?>" alt="">
    <input type="file" name="profileImg" id="profileImg" accept="image/gif, image/jpeg, image/png, image/jpg">

    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname" value="<?php echo $profile['firstname']; ?>">

    <label for="lastname">lastname</label>
    <input type="text" name="lastname" id="lastname" value="<?php echo $profile['lastname'];?>"> 

    <label for="bio">Bio</label>
    <textarea rows="4" cols="50" name="bio" id="bio"><?php echo $profile['bio'];?></textarea>

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" value="<?php echo $profile['email']; ?>">

    <label for="password">New password</label>
    <input type="password" name="password" id="password" placeholder="New password">

    <input type="submit" name="edit" value="Edit">
</form>
</body>
</html>