<?php
include_once("functions.php");

if( !empty($_POST)){

    $username = $_POST["email"];
    $password = $_POST["password"];

    //controleren of een gebruiker kan inloggen (functie)
    if (canilogin($username, $password)){
        
        session_start();
        // Als login slaagt moet er een session aangemaakt worden van de ingelogde gebruiker
        $_SESSION["username"] = $username;
        $_SESSION["loggedin"] = true;
    }
    // if no -> moet er een $error getoont worden
    // if yes -> naar pagina gebruiker (ingelogd)

}



//session_start();
// Als login slaagt moet er een session aangemaakt worden van de ingelogde gebruiker

//IF LOGGED IN = TRUE

$_SESSION["user_id"] = 1;
$_SESSION["loggedin"] = true;

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amuser</title>
</head>
<body>
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