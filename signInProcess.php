<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

session_start();

$email = $_POST["e"];
$password = $_POST["p"];

if (empty($email)) {
    echo ("Please enter your Email");
} else if (strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must in between 5-20 characters");
} else {

    $a_rs = Database::search("SELECT * FROM `admin`");
    $a_data = $a_rs->fetch_assoc();

    
    if($password == $a_data["password"] && $email == $a_data["email"]){

        $rs3 = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
        $n3 = $rs3->num_rows;

        if ($n3 == 1) {

            $code = uniqid();
            Database::iud("UPDATE `admin` SET `v_code`='".$code."' WHERE `email`='".$email."'");
    
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gimhanaakilatmd@gmail.com';
            $mail->Password = 'rfhwdgbctusyhyjg';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('gimhanaakilatmd@gmail.com', 'Reset Password');
            $mail->addReplyTo('gimhanaakilatmd@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;
    
            if(!$mail->send()){
                echo("Verification code sending Faild");
            }else{
                echo("Success3");
            }

        } else {
            echo ("Invalid Email or Password");
        }

    }else if($password == $a_data["password"]){

        $rs2 = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        $n2 = $rs2->num_rows;

        if ($n2 == 1) {

            $rs_data2 = $rs2->fetch_assoc();
        
            if ($rs_data2["u_status_id"] == 1) {
    
                $_SESSION["u"] = $rs_data2;
                echo ("Success2");
            } else {
                echo ("Your Account has been suspended. Contact the admin");
            }
        } else {
            echo ("Invalid Email or Password");
        }

    }else{

        $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "';");
        $n = $rs->num_rows;

        if ($n == 1) {

            $rs_data2 = $rs->fetch_assoc();
        

            if ($rs_data2["u_status_id"] == 1) {
                $_SESSION["u"] = $rs_data2;
                echo ("Success");
            } else {
                echo ("Your Account has been suspended. Contact the admin");
            }
        } else {
            echo ("Invalid Email or Password");
        }

    }

}

?>