<?php

require "connection.php";

$email = $_POST["e"];
$password = $_POST["pw"];
$mobile = $_POST["m"];
$rcode = $_POST["rc"];
$rc = uniqid();
$vcode = uniqid();

if(empty($email)){
    echo("Please enter your Email !!!");
}else if(strlen($email) >= 100){
    echo("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid email !!!");
}else if(empty($password)){
    echo("Please enter your Password !!!");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo("Password must in between 5-20 characters");
}else if(empty($mobile)){
    echo("Please enter your Mobile !!!");
}else if(strlen($mobile) != 10){
    echo("Mobile must have 10 characters");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Invalid mobile Number !!!");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $rs_num = $rs->num_rows;

    if($rs_num != 0){

        echo("User already exists");

    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        if(empty($rcode)){
            $rcode = "";

            Database::iud ("INSERT INTO `user` (`email`,`name`,`mobile`,`password`,`v_code`,`r_date`,`r_code`,`u_status_id`) 
            VALUES ('".$email."','....','".$mobile."','".$password."','".$vcode."','".$date."','".$rc."','1')");

            Database::iud("INSERT INTO `b_wallet` (`balance`, `user_email`) 
            VALUES ('0', '".$email."')");

            echo("Success");

        }else{
            
            $rcode = $_POST["rc"];

            $r_rs = Database::search("SELECT * FROM `user` WHERE `r_code`='".$rcode."'");
            $r_num = $r_rs->num_rows;

            if($r_num > 0){

                Database::iud ("INSERT INTO `user` (`email`,`name`,`mobile`,`password`,`v_code`,`r_date`,`r_code`,`u_status_id`) 
                VALUES ('".$email."','....','".$mobile."','".$password."','".$vcode."','".$date."','".$rc."','1')");

                Database::iud("INSERT INTO `b_wallet` (`balance`, `user_email`) 
                VALUES ('0', '".$email."')");

                Database::iud("INSERT INTO `referral` (`user_email`,`refer_code`) VALUES ('".$email."','".$rcode."')");

                echo("Success");
            }else{
                echo("Invalid Referral Code");
            }     

        }

    }

}

?>