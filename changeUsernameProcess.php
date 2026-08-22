<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $user = $_SESSION["u"];

    $un = $_POST["userName"];

    Database::iud("UPDATE `user` SET `name`='".$un."' WHERE `email`='".$user["email"]."'");

    echo("Success");

}

?>