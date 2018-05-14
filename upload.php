<?php
session_start();
include_once("classes/posts.class.php");
include_once("classes/location.class.php");
if(!empty($_POST)){
    try{
        $post = new Posts();
        $post->tmp = $_FILES["fileToUpload"];
        //$post->PhotoCheck();
        $post->setImage_text($_POST["image_text"]);
        $post->setUser_id($_SESSION["user_id"]);
        $post->setLocatie = $_POST['city'];
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
<?php include_once("includes/header.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>
		<form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <div>
            <textarea id="image_text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>
          </div>
          <input type="hidden" name="lng" value="" id="lng">
            <input type="hidden" name="lat" value="" id="lat">
        <div id="map"></div>

        <br>
        <input type="submit" value="Upload picture" name="Upload">
        
    </form>
<script src="https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCVPRko-3ZujwaomOO99Qqonwm2hAUeNHs"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
<script src="js/script.js"></script>   
<script type="text/javascript" src="js/geolocation.js" ></script> 

</body>
</html>