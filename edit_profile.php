<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once("classes/User.class.php");

$user = new User();
$user->setUser_id($_SESSION["user_id"]);
$profile = $user->getUserInfo();
var_dump($profile);

//GET USER DATA (UIT CLASS)
$query = "SELECT * FROM users WHERE id = "

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
<h2>Edit profile</h2>
    <form action="post">
    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname">

    <label for="lastname">lastname</label>
    <input type="text" name="lastname" id="lastname">

    <label for="password">New password</label>
    <input type="password" name="password" id="password" placeholder="New password">

    <button>submit</button>
</form>
</body>
</html>