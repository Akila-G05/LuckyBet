<?php

require "connection.php";

$array;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$session_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC");
$session_data = $session_rs->fetch_assoc();

$currentDateTime = date($session_data["time"]);
$threeMinutesLater = date('Y-m-d H:i:s', strtotime('+3 minutes', strtotime($currentDateTime)));

$array["time"] = $threeMinutesLater;
$array["time2"] = $date;

echo json_encode($array);

// echo $currentDateTime;

?>