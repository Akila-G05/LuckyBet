<?php
// Your IPN handler logic goes here

// Example: Update user's wallet balance or mark the transaction as completed in your database
file_put_contents('ipn_log.txt', json_encode($_POST) . PHP_EOL, FILE_APPEND);

echo 'IPN received successfully.';
?>
