<?php
session_start();
// Als login slaagt moet er een session aangemaakt worden van de ingelogde gebruiker

//IF LOGGED IN = TRUE

$_SESSION["user_id"] = 1;
$_SESSION["loggedin"] = true;

?>