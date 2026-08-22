    <?php

require "connection.php";
session_start();

$bets_rs = Database::search("SELECT * FROM `bets` WHERE `status_id` = '1'");
$bets_num = $bets_rs->num_rows;

if (!empty($bets_num)){

    for($x = 0; $x < $bets_num; $x++){

        $bets_data = $bets_rs->fetch_assoc();

        $session_rs2 = Database::search("SELECT * FROM `session` WHERE `id`='".$bets_data["session_id"]."'");
        $session_num2 = $session_rs2->num_rows;

        if(!empty($session_num2)){

            $profit = 0;

            
            $sid = $bets_data["session_id"];
            $invest = $bets_data["invest"];

            $session_rs = Database::search("SELECT * FROM `session` WHERE `id`='".$sid."'");
            $session_data = $session_rs->fetch_assoc();
            
            if($bets_data["color_id"] == 0){
                if($bets_data["number"] != 10){
                    //Number Process
                    if($bets_data["number"] == $session_data["result"]){
                        $profit = $invest * 9;
                    }else{
                        $profit = 0;
                    }
                }
            }else{
                // Color Process
                if($bets_data["color_id"] == $session_data["color_id"]){
                    if($session_data["color_id1"] == 0){
                        $profit = $invest * 2;
                    }else{
                        $profit = $invest * 1.5;
                    }
                }else if($bets_data["color_id"] == $session_data["color_id1"]){
                    $profit = $invest * 4;
                }else{
                    $profit = 0;
                }
            }

            $wallet_rs = Database::search("SELECT * FROM `b_wallet` WHERE `user_email`='".$bets_data["user_email"]."'");
            $wallet_data = $wallet_rs->fetch_assoc();

            $balance = $wallet_data["balance"];
            $newBalance = $balance + $profit;

            Database::iud("UPDATE `b_wallet` SET `balance`='".$newBalance."' WHERE `user_email`='".$bets_data["user_email"]."'");

            if($profit == 0){
                $profit = $invest * -1;
            }

            Database::iud("INSERT INTO `result` (`profit`,`bets_id`) VALUES ('".$profit."', '".$bets_data["id"]."')");
            Database::iud("UPDATE `bets` SET `status_id`='2' WHERE `id`='".$bets_data["id"]."'");

        }

    }

}

echo("Success");



?>