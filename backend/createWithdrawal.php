<?php

require "../connection.php";
session_start();
// Ignore this line if using composer autoload,
// otherwise, manual wrapper usage include the following require:
require('../src/CoinpaymentsAPI.php');

// Either include the sample keys.php file (once populated) or manually set $public_key and $private_key variables
require('../src/keys_example.php');

// Create a new API wrapper instance and call to the get basic account information command.

$currency = $_POST["currency"];
$amount = $_POST["amount"];
$address = $_POST["address"];
$auto_confirm = $_POST["auto_confirm"];

$array = array("currency"=>$currency,"amount"=>(int)$amount,"address"=>$address,"auto_confirm"=>(int)$auto_confirm);

try {
    $cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');
    $information = $cps_api->CreateWithdrawal($array);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Check for success of API call
if ($information['error'] == 'ok') {
    // Prepare start of sample HTML output
    $output = '<table><tbody><tr><td>id</td><td>Merchant ID</td><td>Status</td><td>Amount</td></tr>';
    $output .= '<tr><td>' . $information['result']['id']. '</td><td>' . $information['result']['status'] . '</td><td>' . $information['result']['amount'] . '</td><td></tr>' ;
    
    // Close the sample output HTML and echo it onto the page
    $output .= '</tbody></table>';
    Database::iud("UPDATE `b_wallet` WHERE `balance`='".$amount."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");
    echo $output;
} else {
    // Throw an error if both API calls were not successful
    echo 'There was an error returned by the API call: ' . $information['error'];
}

?>