<?php

require "connection.php";

if(!empty($_GET["e"])){

    $email = $_GET["e"];

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $user_data = $user_rs->fetch_assoc();

    if($user_data["u_status_id"] == 1){
        Database::iud("UPDATE `user` SET `u_status_id`='2' WHERE `email`='".$email."'");
        echo("Success");
    }else{
        Database::iud("UPDATE `user` SET `u_status_id`='1' WHERE `email`='".$email."'");
        echo("Success");
    }

}

?>