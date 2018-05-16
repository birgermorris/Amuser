<?php
    include_once("classes/User.class.php");
    include_once("classes/posts.class.php");
    include_once("classes/reaction.class.php");
    include_once("includes/functions.inc.php");
    session_start();

    if(isset($_GET['user'])){
        $collectionData = new Posts();
        $collectionData->setUser_id($_GET['user']);
        $collection = $collectionData->getPostsbyUser();
    }

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
<div class="container">
<div class="profile-container">
    <?php 
        if(isset($_GET['user'])){
            $user = new User();
            $user->setUser_id($_GET['user']);
            $thisUser = $user->getUserInfo();
        }
    ?>
    <h2><?php echo $thisUser['firstname'] . " " . $thisUser['lastname']; ?></h2>
    <b>Bio:</b>
    <p><?php $text = preg_replace('/(?:^|\s)#(\w+)/', ' <a href="search.php?search=%23$1">#$1</a>', $thisUser['bio']); echo $text; ?></p>
</div>
<div class="grid-container">
    <?php foreach($collection as $c): ?>
    <div class="grid-item">
        <?php if($c["user_id"] == $_SESSION["user_id"]): ?>
        <a href="./delete.php?id=<?php echo $c['id']; ?>" id="deletepost" class="btn btn-danger" data-id="<?php echo $c['id']; ?>">Delete</a>
        <?php endif; ?>
        <div class="postInfo">
            <div class="timeAgo"><?php echo timing($c['upload_time']); ?></div>
            <div class="location"></div>
        </div>
        <div class="img-responsive filter<?php echo $c["filter_id"]; ?>" 
        style="width:100%;height:350px;background-image:url(<?php echo $c['image']; ?>
        );background-repeat:no-repeat;background-size:cover;background-position:50% 50%;">
        </div>
        <div class="description">    
            <p><?php echo $c['image_text']; ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>
</body>
</html>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/script.js"></script>