<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("classes/User.class.php");

if(!empty($_SESSION["loggedin"])){
    header("Location: index.php");
}
else{
    if(!empty($_POST)){
        $user = new User();
        $user->setEmail($_POST["email"]);
        $user->setPassword_login($_POST["password"]);

        //controleren of een gebruiker kan inloggen (functie)
        if ($user->login()){
            session_start();
            // Als login slaagt moet er een session aangemaakt worden van de ingelogde gebruiker
            $_SESSION["user_id"] = $user->getUser_id();
            $_SESSION["loggedin"] = true; 
            header("Location: index.php");
        }
        else{
            $error = "Foutieve gegevens";
        }
        // if no -> moet er een $error getoont worden
        // if yes -> naar pagina gebruiker (ingelogd)

    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amuser</title>
</head>
<body>

<?php include_once("includes/header.inc.php"); ?>
<?php include_once("includes/error.inc.php"); ?>
    <div class="netflixLogin">
        <form action="" method="post">

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">
				</div>
	    </form>
    </div>
</body>
</html>