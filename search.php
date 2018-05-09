<?php 
    include_once("classes/search.class.php");
    include_once("classes/hashtag.class.php");
    include_once("includes/functions.inc.php");

    session_start();

    if (!empty($_GET["search"])) {
        $search = new Search();
        $search->setSearchText($_GET["search"]);
        $results = $search->search();
    }

    if(isset($_POST["unfollowHashtag"])){
        $hashtag = new Hashtag();
        $hashtag->setHashtag_id($_POST["hashtag_id"]);
        $hashtag->setUser_id($_SESSION["user_id"]);
        $hashtag->unfollowHashtag();
    }

    if(!empty($_POST["search"])){
    if(isHashtag($_POST["search"]) && isset($_POST["followHashtag"])){
        $hashtag = new Hashtag();
        $hashtag->setHashtag($_POST['search']);
        if($hashtag->exists()){
            $hashtagInfo = $hashtag->getHashtagInfo(); 
            $hashtag->setHashtag_id($hashtagInfo["id"]);
            $hashtag->setUser_id($_SESSION["user_id"]);
            $hashtag->followHashtag();
        } else {
            $hashtag->createHashtag();
            $hashtagInfo = $hashtag->getHashtagInfo(); 
            $hashtag->setHashtag_id($hashtagInfo["id"]);
            $hashtag->setUser_id($_SESSION["user_id"]);
            $hashtag->followHashtag();
        }
    }};

    if(isHashtag($_GET["search"])){
        $uFollowsHashtag = new Hashtag();
        $uFollowsHashtag->setHashtag($_GET["search"]);
        if($uFollowsHashtag->exists()){
            $uFollowHashinfo = $uFollowsHashtag->getHashtagInfo();
            $uFollowsHashtag->setHashtag_id($uFollowHashinfo["id"]);
            $uFollowsHashtag->setUser_id($_SESSION["user_id"]);
            $hashfollow = $uFollowsHashtag->checkIfFollow();
        } else {
            $hashfollow = false;
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Zoeken: <?php echo $_GET["search"]; ?></title>
</head>
<body>
<?php include_once("includes/header.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>

    <h1>Zoeken: <?php echo $_GET["search"]; ?></h1>
    <?php if(isHashtag($_GET["search"]) && $hashfollow == false ): ?>
    <form action="search.php?search=<?php echo urlencode($_GET["search"]); ?>" method="post"><input type="hidden" name="search" id="search" value="<?php echo $_GET["search"]; ?>"><input type="submit" class="searchbutton" name="followHashtag" value="Follow"></form>
    <?php elseif(isHashtag($_GET["search"]) && $hashfollow == true): ?>
    <form action="search.php?search=<?php echo urlencode($_GET["search"]); ?>" method="post"><input type="hidden" name="hashtag_id" id="hashtag_id" value="<?php echo $uFollowHashinfo['id']; ?>"><input type="submit" class="searchbutton" name="unfollowHashtag" value="Unfollow"></form>
    <?php endif; ?>
    
    <?php foreach ($results as $result): ?>
    <div class="grid-item">
        <div class="">
            <div class="username">USERNAME</div>
            <div class="timeAgo"><?php echo timing($result['upload_time']); ?></div>
        </div>
        <div class="thumbnail" style="width:400px;height:400px;background-image:url(<?php echo $result['image']; ?>);background-repeat:no-repeat;background-size:cover;background-position:50% 50%;">
        </div>
        <div class="description">    
            <p><?php echo $result['image_text']; ?></p>
        </div>
    </div>    
    <?php endforeach; ?>
</body>
</html>