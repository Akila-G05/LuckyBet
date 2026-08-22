<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $user = $_SESSION["u"];

    $session_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC");
    $session_data = $session_rs->fetch_assoc();

    $sid = $session_data["id"] + 1;
    $price = $_POST["price"];
    $color = $_POST["color"];

    if(!empty($color)){

        $w_rs = Database::search("SELECT * FROM `b_wallet` WHERE `user_email`='".$user["email"]."' ");
        $w_data = $w_rs->fetch_assoc();

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        if($w_data["balance"] < $price){
            echo("Insufficient Balance");
        }else{

            $new_w_balance = $w_data["balance"] - $price;

            Database::iud("UPDATE `b_wallet` SET `balance`='".$new_w_balance."' WHERE `user_email`='".$user["email"]."'");

            Database::iud("INSERT INTO `bets` (`session_id`, `invest`, `time`, `color_id`, `number`, `user_email`, `status_id`) 
            VALUES ('".$sid."', '".$price."', '".$date."', '".$color."', '10', '".$user["email"]."', '1')");

            echo("Success");

        }

    }else{
        echo("Please Select Color..");
    }

}else{
    echo("Please Signin Frist");
}

?>