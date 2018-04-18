<?php 
    $db = mysqli_connect("localhost", "root", "root", "amuser");
    $result = mysqli_query($db, "SELECT * FROM posts");
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

    <h1>Hello world</h1>
    <a href="upload.php">Upload file</a>
    <?php while($row = mysqli_fetch_array($result)): ?>
        <div class="img_div">
            <img src="data/post/<?php echo $row['image'] ?>">
            <p><?php echo $row['image_text'] ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>