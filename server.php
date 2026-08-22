<?php

require "connection.php";


while(true){

    $insertDone = false;

    $session_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC");
    $session_data = $session_rs->fetch_assoc();

    $currentDateTime = date($session_data["time"]);
    $threeMinutesLater = date('Y-m-d H:i:s', strtotime('+3 minutes', strtotime($currentDateTime)));

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if($date > $session_data["ftime"]){

        $t_invest= 0;

        $threeMinutesLater2 = date('Y-m-d H:i:s', strtotime('+3 minutes', strtotime($date)));

        $bets_rs = Database::search("SELECT * FROM `bets` WHERE `status_id` = '1'");
        $bets_num = $bets_rs->num_rows;

        $admin_rs = Database::search("SELECT * FROM `admin`");
        $admin_data = $admin_rs->fetch_assoc();

        // Define the URL for fetching the BTC/USDT price from Binance API
        $apiUrl = "https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT";

        // Make a GET request to Binance API
        $response = file_get_contents($apiUrl);

        // Check if the request was successful
        if ($response === FALSE) {
            die("Error fetching BTC/USDT price");
        }

        // Decode the JSON response
        $data = json_decode($response, true);

        // Extract the BTC/USDT price from the data
        $btcusdtPrice = isset($data['price']) ? (float)$data['price'] : null;

        // Check if the price is available
        if ($btcusdtPrice !== null) {
            // Extract the last character (the last digit)
            $lastCharacter = substr(number_format($btcusdtPrice, 2, '.', ''), -1);
            $btcPrice3 = number_format($btcusdtPrice, 2, '.', '');

        } else {
            echo "Error: BTC/USDT price not available";
        }

        if(!empty($bets_num)){
            
            for($x = 0; $x < $bets_num; $x++){

                $bets_data = $bets_rs->fetch_assoc();

                $t_invest += $bets_data["invest"];

            }

        }

        // $btcPrice = $_POST["btc"];
        $btcPrice = $btcPrice3;
        $numberString = number_format($btcPrice, 2, '.', '');


        if($t_invest > $admin_data["bet_count"]){

            $bets_rs2 = Database::search("SELECT * FROM `bets` WHERE `status_id` = '1'");
            $bets_num2 = $bets_rs2->num_rows;

            //trick
            $red = 0;
            $green = 0;
            $violet = 0;

            for($y = 0; $y < $bets_num2; $y++){

                $bets_data2 = $bets_rs2->fetch_assoc();

                if($bets_data2["color_id"] == 1){
                    $red += $bets_data2["invest"];
                }else if($bets_data2["color_id"] == 2){
                    $green += $bets_data2["invest"];
                }else if($bets_data2["color_id"] == 3){
                    $violet += $bets_data2["invest"];
                }

            }

            $colors_array = array($red, $green, $violet);
            $number_array = [1, 3, 7, 9];
            $number_array2 = [2, 4, 6, 8];

            $min_color = min($colors_array);

            if($min_color == $red){
                $color = 1;
                $color2 = 0;
            }else if($min_color == $green){
                $color = 2;
                $color2 = 0;
            }else if($min_color == $violet){
                $colors_array2 = array($red, $green);
                $min_color2 = min($colors_array2);

                if($min_color2 == $red){
                    $color = 1;
                }else{
                    $color = 2;
                }

                $color2 = 3;
            }

            if($color == 1 && $color2 == 0){
                $randomIndex  = array_rand($number_array2);
                $result = $number_array2[$randomIndex];
            }else if($color == 2 && $color2 == 0){
                $randomIndex  = array_rand($number_array);
                $result = $number_array[$randomIndex];
            }else if($color == 1 && $color2 == 3){
                $result = 0;
            }else if($color == 2 && $color2 == 3){
                $result = 5;
            }
            


            $numberStringWithoutLastDigit = substr($numberString, 0, -1);
            $btcPrice2 = $numberStringWithoutLastDigit . $result;


        }else{

            //Genarate

            // $btcPrice2 = $_POST["btc"];
            $btcPrice2 = $btcPrice3;

            // Convert to a string with two decimal places
            $result = substr(strrchr($numberString, '.'), -1);

            $color;
            $color2;

            $array = array(1, 3, 7, 9);
            $array2 = array(2, 4, 6, 8);

            if(in_array($result, $array)){
                $color = 2;
                $color2 = 0;
            }else if(in_array($result, $array2)){
                $color = 1;
                $color2 = 0;
            }else if($result == 0){
                $color = 1;
                $color2 = 3;
            }else if($result == 5){
                $color = 2;
                $color2 = 3;
            }

        }

        if($admin_data["bet_status"] == 1){

            if (!$insertDone) {

                
                Database::iud("INSERT INTO `session` (`price`, `result`, `time`, `ftime`, `color_id`, `color_id1`) 
                VALUES ('" . $btcPrice2 . "', '" . $result . "', '" . $date . "', '" . $threeMinutesLater2 . "', '" . $color . "', '" . $color2 . "')");

                $insertDone = true; // Set the flag to true after insertion
            }

        }else{
            Database::iud("UPDATE `admin` SET `bet_status`='1'");
        }

    }


    // sleep(180);

}


?>


