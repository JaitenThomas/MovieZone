<?php 
    require_once('movie_zone_main.php');



    session_start();
    $_SESSION = array();
    session_destroy();

    header("Location: moviezone.php");
?>
