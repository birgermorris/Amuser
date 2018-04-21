<?php 
    $db = mysqli_connect("localhost", "root", "root", "amuser");
    $result = mysqli_query($db, "SELECT * FROM posts");
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

    <h1>Hello world</h1>
    <a href="upload.php">Upload file</a>
    <?php while($row = mysqli_fetch_array($result)): ?>
        <div class="img_div">
            <img src="data/post/<?php echo $row['image'] ?>">
            <p><?php echo $row['image_text'] ?></p>
        </div>
    <?php endwhile; ?>

<button class="btnLoadMore" type="load more" href="#">Load more</button>

</body>
</html>

<script   src="http://code.jquery.com/jquery-3.3.1.min.js"   
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   
crossorigin="anonymous"></script>

<script src="js/script.js"></script>