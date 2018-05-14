<?php
    include_once("classes/posts.class.php");
    if(isset($_GET['id'])){
        $post = new Posts();
        $post->deletePost($_GET['id']);
        header("Location: index.php");
    }
?>