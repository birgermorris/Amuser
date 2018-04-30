<?php
session_start();
include_once("classes/posts.class.php");
if(!empty($_POST)){
    try{
        $post = new Posts();
        $post->tmp = $_FILES["fileToUpload"];
        //$post->PhotoCheck();
        $post->setImage_text($_POST["image_text"]);
        $post->setUser_id($_SESSION["user_id"]);
        $post->PhotoUpload();
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage;
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
		<form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <div>
            <textarea id="image_text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>
  	    </div>
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>
</html>