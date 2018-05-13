<?php
    include_once("classes/User.class.php");
    include_once("classes/posts.class.php");
    include_once("classes/reaction.class.php");
    include_once("includes/functions.inc.php");
    session_start();
    $user = $_SESSION['user_id'];
    $collection = Posts::getAll();

    if(isset($_POST['reaction']) && !empty($_POST['reaction']) && !empty($_POST["post_id"])){
        $reaction = new Reaction();
        $reaction->setPost_id($_POST["post_id"]);
        $reaction->setUser_id($_SESSION['user_id']);
        $reaction->setReaction_text($_POST["reaction"]);
        $reaction->create();
    }

    if(isset($user)){
            $post = new Posts();
            $post->deletePost($user_id);
        }
        else {
    }
/*

$no = $_POST['getresult'];
$post = new Posts();
$items = $post->loadMore($no);
*/
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
    <?php 
        $user = new User();
        $user->setUser_id($c['user_id']);
        $thisUser = $user->getUserInfo();
    ?>
    <div class="grid-item">
        <a href="./succes.php" id="deletepost" class="btn btn-danger" data-id="<?php echo $test['id']; ?>">Delete</a>
        <div class="">
            <div class="username"><a href="profile.php"><?php echo $thisUser["firstname"] . " " . $thisUser["lastname"] ?></a></div>
            <div class="timeAgo"><?php echo timing($c['upload_time']); ?></div>
        </div>
        <div class="thumbnail" 
        style="width:400px;height:400px;background-image:url(<?php echo $c['image']; ?>
        );background-repeat:no-repeat;background-size:cover;background-position:50% 50%;">
        </div>
        <div class="description">    
            <p><?php echo $c['image_text']; ?></p>
        </div>
        <div class="reactions" data-id="<?php echo $c['id']?>">
        <?php
            $reactions = new Reaction();
            $postReactions = $reactions->getReactionsOfPost($c["id"]);
        ?>
        <h4>Reacties:</h4>
        <?php foreach($postReactions as $postReaction): ?>
        <?php
            $reactionUser = new User();
            $reactionUser->setUser_id($postReaction["user_id"]);
            $reactionUserData = $reactionUser->getUserInfo();
        ?>
        <p>
        <?php echo $reactionUserData["firstname"] . " " . $reactionUserData["lastname"] . ": " . $postReaction["reaction_text"]; ?>
        </p>
        <?php endforeach; ?>
         </div>
        <div class="react">
            <form action="" method="post" name="react">
            <input type="text" hidden name="post_id" id="post_id" value="<?php echo $c["id"]; ?>">
            <input type="text" name="reaction" id="reaction">
            <input type="submit" id="addReaction" name="addReaction" class="addReaction" data-id="<?php echo $c["id"]?>">
            </form>
        </div>
    </div>    
    <?php endforeach; ?>
</div>

<?php if(count($post->getAll()) == 20): ?>
    <input type="hidden" id="result_no" value="20">
    <button><a href="#" id="btn_loadmore">Load More</a></button>
<?php endif; ?>

</body>
</html>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/script.js"></script>