<?php
spl_autoload_register(function ($class){
    include_once("classes/" . $class . ".class.php");


});
session_start();
if(empty($_SESSION['user_id'])){
    header('Location:login.php');
}




?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>Post <?php echo $user_id ?></title>
</head>
<body>
    
    <div>Uw post is succesvol verwijderd!</div>
    <div><a href="index.php">Go back</a></div>
    
</body>
</html>