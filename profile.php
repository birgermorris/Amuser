<?php
    include_once("classes/User.class.php");
    include_once("classes/posts.class.php");
    include_once("classes/reaction.class.php");
    include_once("includes/functions.inc.php");
    session_start();
    $collection = new Posts();
    $collection->getMine();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php include_once("includes/header.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>
<div class="grid-container">
    <?php foreach($collection as $c): ?>

    <div class="grid-item">
        <div class="img-responsive" 
        style="width:100%;height:350px;background-image:url(<?php echo $c['image']; ?>
        );background-repeat:no-repeat;background-size:cover;background-position:50% 50%;">
        </div>

        
    </div>    
    <?php endforeach; ?>
</div>

</body>
</html>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/script.js"></script>