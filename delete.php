<?php
    include_once("classes/posts.class.php");
    session_start();
    if(isset($_GET['id'])){
        $post = new Posts();
        $post->deletePost($_GET['id'], $_SESSION['user_id']);
        header("Location: index.php");
    }
?>