<?php
session_start();
spl_autoload_register(function($class){
    include_once("classes/". $class . ".class.php");
});
if (empty($_SESSION["loggedin"])) {
    $_SESSION["loggedin"] = false;
}

if ($_SESSION["loggedin"] == false     
&& basename($_SERVER["SCRIPT_NAME"]) != "login.php"
&& basename($_SERVER["SCRIPT_NAME"]) != "register.php") {
    header("Location: login.php");
    die();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Nav</title>
</head>
<body>
<header>
        <nav class="container">
        <a class="logo" href="index.php"></a>
        <div class="search"><form action="search.php" method="get"><input type="text" name="search" id="search" placeholder="Search" ><input type="submit" value="zoeken"></form></div>
        <div class="profile_header">
            <img src="" alt="">
        </div>
        </nav>
</header>
    
</body>
</html>


