<?php
header('Content-Type: application/json');
include_once("../Classes/Db.class.php");
include_once("../Classes/Post.class.php");


$p = new Post();

/* Geef als parameter mee wat er naar deze pagina gepost is (= 'id') */
/*$p->deletePost($user_id);*/