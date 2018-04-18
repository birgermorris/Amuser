<?php 
    include_once("classes/search.class.php");

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
    <title>Zoeken: <?php echo $_GET["search"]; ?></title>
</head>
<body>
<?php include_once("includes/header.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>

    <h1>Zoeken: <?php echo $_GET["search"]; ?></h1>
    
    <?php foreach ($results as $result): ?>
        <div class="img_div">
            <img src="data/post/<?php echo $result['image'] ?>">
            <p><?php echo $result['image_text']; ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>