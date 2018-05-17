<?php
session_start();
include_once("classes/posts.class.php");
include_once("classes/location.class.php");
include_once("classes/filter.class.php");

if(!empty($_POST)){
    try{
        $post = new Posts();
        $post->tmp = $_FILES["fileToUpload"];
        //$post->PhotoCheck();
        $post->setImage_text($_POST["image_text"]);
        $post->setUser_id($_SESSION["user_id"]);
        $post->setLat($_POST['lat']);
        $post->setLng($_POST['lng']);
        $post->setFilter_id($_POST["filter"]);
        $post->PhotoUpload();
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage;
    }
}

$filter = new Filter();
$allFilters = $filter->getFilters();

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img.imgPreview, img.imageFilter {
            width:auto;
        }

        .filters {
            display:flex;
            flex-wrap:wrap;
        }

        .filters img {
            margin-right:10px;
        }
        </style>
</head>
<body>
<?php include_once("includes/header.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>
		<form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
<<<<<<< HEAD
        <div class="filters">
            <img src="" alt="" class="_1977">
            <img src="" alt="" class="aden">
            <img src="" alt="" class="brannan">
            <img src="" alt="" class="brooklyn">
            <img src="" alt="" class="clarendon">
            <img src="" alt="" class="earlybird">
            <img src="" alt="" class="nashville">
            <img src="" alt="" class="willow">
            <img src="" alt="" class="walden">
            <img src="" alt="" class="toaster"">

=======
        <div style="text-align:center">
        <img class="imgPreview" style="height:auto; max-height:400px; max-width:100%;">
    </div>
        <div class="filters">
        <?php foreach($allFilters as $f): ?>
            <img style="height:50px; max-width:100%;" class="imageFilter filter<?php echo $f["filter_number"]; ?>" data-id="<?php echo $f["filter_number"]; ?>">
<?php endforeach; ?>
>>>>>>> f3464f060b9b74c0e7d4073405f55700cb08aee7
        </div>
        <div>
            <textarea id="image_text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>
          </div>
          <input type="hidden" name="filter" value="" id="filter">
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.imgPreview').css("margin-bottom", "10px");
                $('.imageFilter').css("display", "inline-block");
                $('.imgPreview').attr('src', e.target.result);
                $('.imageFilter').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#fileToUpload").change(function(){
        readURL(this);
    });
    $(".filters img").click(function(){
        var element = $(".imgPreview");
        $(".imgPreview").removeClass();
        element.addClass("filter" + $(this).data("id"));
        element.addClass("imgPreview");
        $("#filter").val($(this).data("id"));
    });
    </script>

</body>
</html>