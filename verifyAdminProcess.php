<?php

require "connection.php";
session_start();

$vc = $_GET["vc"];

if(!empty($vc)){

    $rs = Database::search("SELECT * FROM `admin`");
    $data = $rs->fetch_assoc();

    if($data["v_code"] == $vc){
        $_SESSION["au"] = $data;
        echo ("Success");
    }else{
        echo("Invalid Verification Code..");
    }

}

?>