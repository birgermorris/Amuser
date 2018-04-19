<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Nav</title>
</head>
<body>
<header>
        <nav class="container">
        <a class="logo" href="index.php"></a>
        <div class="search"><form action="search.php" method="get"><input type="text" name="search" id="search" placeholder="Search" ><input type="submit" value="zoeken"></form></div>
        <div class="profile_header">
            <img src="" alt="">
            <?php if(isset($_SESSION["loggedin"])): ?><p>NAME</p>
            <?php endif; ?>
        </div>
        </nav>
</header>
    
</body>
</html>


