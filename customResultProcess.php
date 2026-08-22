<?php

require "connection.php";

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

$btcPrice = $btcPrice3;
$numberString = number_format($btcPrice, 2, '.', '');

if(!empty($_GET["n"]) OR $_GET["n"] == 0){

    Database::iud("UPDATE `admin` SET `bet_status`='2'");

    $result = $_GET["n"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
        
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

    $numberStringWithoutLastDigit = substr($numberString, 0, -1);
    $btcPrice2 = $numberStringWithoutLastDigit . $result;

    Database::iud("INSERT INTO `session` (`price`, `result`, `time`, `color_id`, `color_id1`) 
    VALUES ('" . $btcPrice2 . "', '" . $result . "', '" . $date . "', '" . $color . "', '" . $color2 . "')");

    echo ("Success");

}else{
    echo("Please Select Number..");
}

?>