<?php

require "connection.php";

$s_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC");
$s_data = $s_rs->fetch_assoc();

$s_id = $s_data["id"] + 1;
echo($s_id);

?>