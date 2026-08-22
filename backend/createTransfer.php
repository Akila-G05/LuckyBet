<?php

// Ignore this line if using composer autoload,
// otherwise, manual wrapper usage include the following require:
require('../src/CoinpaymentsAPI.php');

// Either include the sample keys.php file (once populated) or manually set $public_key and $private_key variables
require('../src/keys_example.php');

// Create a new API wrapper instance and call to the get basic account information command.

$currency = $_POST["currency"];
$amount = $_POST["amount"];
$auto_confirm = $_POST["auto_confirm"];
$merchant = $_POST["merchant"];
try {
    $cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');
    $information = $cps_api->CreateMerchantTransfer((int)$amount, $currency, $merchant);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Check for success of API call
if ($information['error'] == 'ok') {
    // Prepare start of sample HTML output
    $output = '<table><tbody><tr><td>id</td><td>Status</td><td>Email</td><td>amount</td></tr>';
    $output .= '<tr><td>' . $information['result']['id']. '</td><td>' . $information['result']['status'] . '</td><td>' . $information['result']['amount'] . '</td><td>' ;
    
    // Close the sample output HTML and echo it onto the page
    $output .= '</tbody></table>';
    echo $output;
} else {
    // Throw an error if both API calls were not successful
    echo 'There was an error returned by the API call: ' . $information['error'];
}
