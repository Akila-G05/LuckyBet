<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $betCount = $_GET["b"];

    Database::search("UPDATE `admin` SET `bet_count`='".$betCount."' WHERE `email`='".$_SESSION["au"]["email"]."'");

    echo("Success");

}

?>