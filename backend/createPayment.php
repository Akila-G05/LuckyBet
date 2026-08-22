<?php

// Ignore this line if using composer autoload,
// otherwise, manual wrapper usage include the following require:
require('../src/CoinpaymentsAPI.php');

// Either include the sample keys.php file (once populated) or manually set $public_key and $private_key variables
require('../src/keys_example.php');

// Create a new API wrapper instance and call to the get basic account information command.

$currency1 = $_POST["currency1"];
$currency2 = $_POST["currency2"];
$amount = $_POST["amount"];
$address = $_POST["address"];
$buyer_email = $_POST["buyer_email"];
$buyer_name = $_POST["buyer_name"];
$item_name = $_POST["item_name"];
$item_number = $_POST["item_number"];
$invoice = $_POST["invoice"];
$invoice = $_POST["invoice"];
$custom = $_POST["custom"];
$ipn_url = $_POST["ipn_url"];

try {
    $cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');
    $information = $cps_api->CreateComplexTransaction((int)$amount, $currency1, $currency2, $buyer_email, $address, $buyer_name, $item_name,$item_number, $invoice, $custom, $ipn_url);;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Check for success of API call
if ($information['error'] == 'ok') {
    // Prepare start of sample HTML output
    $output = '<table><tbody>
    <tr>
    <td>amount</td>
    <td>address</td>
    <td>txn_id</td>
    <td>status_url</td>
    </tr>';
    $output .= '<tr><td>' . $information['result']['amount']. '</td><td>' . $information['result']['address'] . '</td><td>' . $information['result']['txn_id'] . '</td><td>' . $information['result']['status_url'] . '</td></tr>' ;
    
    // Close the sample output HTML and echo it onto the page
    $output .= '</tbody></table>';
    echo $output;
} else {
    // Throw an error if both API calls were not successful
    echo 'There was an error returned by the API call: ' . $information['error'];
}

?>