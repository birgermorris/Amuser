<?php 
    if(isset($_SESSION["user_id"])){

    } else {
        header("Location: login.php");
    }

?>