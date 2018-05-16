<?php 
    include_once("classes/search.class.php");
    include_once("classes/hashtag.class.php");
    include_once("classes/User.class.php");
    include_once("includes/functions.inc.php");

    session_start();

    if (!empty($_GET["location"])) {
        if($_GET["location"]){
            $location = true;
        }
    }

    if (!empty($_GET["search"])) {
        if(!empty($location)){
            $searchTermLocation = getLocation($_GET["search"]);
            $search = new Search();
            $results = $search->searchLocation($searchTermLocation['lat'], $searchTermLocation["lng"]);
        } else {   
            $search = new Search();
            $search->setSearchText($_GET["search"]);
            $results = $search->search();  
        }
    } else {
        header('Location: index.php');
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

<div class="container">
    <div class="flexSearch">
        <div>
    <h1>Zoeken: <?php echo $_GET["search"]; ?></h1>
    <div class="zoekBtn">
        <a href="search.php?search=<?php echo urlencode($_GET["search"]); ?>">Zoek posts</a><a href="search.php?search=<?php echo urlencode($_GET["search"]); ?>&location=true">Zoek locatie</a>
</div>
</div>
    <?php if(isHashtag($_GET["search"]) && $hashfollow == false ): ?>
    <form action="search.php?search=<?php echo urlencode($_GET["search"]); ?>" method="post" class="follow"><input type="hidden" name="search" id="search" value="<?php echo $_GET["search"]; ?>"><input type="submit" class="searchbutton" name="followHashtag" value="Follow"></form>
    <?php elseif(isHashtag($_GET["search"]) && $hashfollow == true): ?>
    <form action="search.php?search=<?php echo urlencode($_GET["search"]); ?>" method="post" class="follow"><input type="hidden" name="hashtag_id" id="hashtag_id" value="<?php echo $uFollowHashinfo['id']; ?>"><input type="submit" class="searchbutton" name="unfollowHashtag" value="Unfollow"></form>
    <?php endif; ?>
    </div>

<?php if(count($results) == 0): ?>
<p> Er zijn helaas geen resultaten gevonden</p>
<?php endif; ?>
<div class="grid-container">
    <?php foreach ($results as $result): ?>
    <?php 
        $user = new User();
        $user->setUser_id($result['user_id']);
        $thisUser = $user->getUserInfo();
    ?>

    <div class="grid-item">
    <div class="">
            <div class="username"><?php echo $thisUser["firstname"] . " " . $thisUser["lastname"] ?></div>
            <div class="timeAgo"><?php echo timing($result['upload_time']); ?></div>
        </div>
        <div class="thumbnail filter<?php echo $result['filter_id']; ?>" style="width:100%;height:350px;background-image:url(<?php echo $result['image']; ?>);background-repeat:no-repeat;background-size:cover;background-position:50% 50%;">
        </div>
        <div class="description">    
            <p><?php echo $result['image_text']; ?></p>
        </div>
    </div>    
    <?php endforeach; ?>
</div>
</div>
</body>
</html>