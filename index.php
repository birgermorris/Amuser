<?php
    include_once("classes/posts.class.php");
    include_once("includes/functions.inc.php");
    $collection = Posts::getAll();
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
        <div class="">
            <div class="username">USERNAME</div>
            <div class="timeAgo"><?php echo timing($c['upload_time']); ?></div>
        </div>
        <div class="thumbnail" style="width:400px;height:400px;background-image:url(<?php echo $c['image']; ?>);background-repeat:no-repeat;background-size:cover;background-position:50% 50%;">
        </div>
        <div class="description">    
            <p><?php echo $c['image_text']; ?></p>
        </div>
    </div>    
    <?php endforeach; ?>
</div>
<button class="btnLoadMore" type="load more" href="#">Load more</button>

</body>
</html>

<script   src="http://code.jquery.com/jquery-3.3.1.min.js"   
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   
crossorigin="anonymous"></script>

<script src="js/script.js"></script>