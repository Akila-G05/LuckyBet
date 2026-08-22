<?php

require "connection.php";
session_start();

$w_rs = Database::search("SELECT * FROM `b_wallet` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
$w_data = $w_rs->fetch_assoc();

echo($w_data["balance"]);

?>