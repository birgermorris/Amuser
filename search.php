<?php 
    include_once("classes/search.class.php");
    include_once("includes/functions.inc.php");

    session_start();

    if (!empty($_GET["search"])) {
        $search = new Search();
        $search->setSearchText($_GET["search"]);
        $results = $search->search();
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