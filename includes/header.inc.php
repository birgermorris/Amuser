<?php
    include_once("includes/loginCheck.php");
    

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/filters.css">
    <title>Nav</title>
</head>
<body>
<header>
        <nav>
            <div class="container">
        <a class="logo" href="index.php"><img src="images/logo.svg" alt="Logo"></a>
        
<div class="search"><form action="search.php" method="get"><input type="text" name="search" id="search" placeholder="Search" <?php if (!empty($_GET["search"])) { ?> value="<?php echo $_GET["search"]?>" <?php }; ?>><input type="submit" class="searchbutton" hidden value="zoeken"></form></div>
        <div class="profile_header">
            <img src="" alt="">
        </div>

        <div class="right_actions">
        <a href="upload.php">Add</a>
        <a href="edit_profile.php">Edit profile</a>
        <a href="logout.php">Log out</a>
        </div>
</div>
        </nav>
</header>
    
</body>
</html>


