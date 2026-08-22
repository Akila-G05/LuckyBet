<?php

require "connection.php";

$bets_rs3 = Database::search("SELECT * FROM `bets` WHERE `status_id` = '1'");
$bets_num3 = $bets_rs3->num_rows;

$red = 0;
$green = 0;
$violet = 0;

$bets_red_num = 0;
$bets_violet_num = 0;
$bets_green_num = 0;

for($y = 0; $y < $bets_num3; $y++){

    $bets_data3 = $bets_rs3->fetch_assoc();

    if($bets_data3["color_id"] == 1){
        $red += $bets_data3["invest"];
        $bets_red_num += 1;
    }else if($bets_data3["color_id"] == 2){
        $green += $bets_data3["invest"];
        $bets_green_num += 1;
    }else if($bets_data3["color_id"] == 3){
        $violet += $bets_data3["invest"];
        $bets_violet_num += 1;
    }

}

?>

<div class="col-3 mx-auto text-center">
    <div class="row">
        <i class="bi bi-circle-fill fs-1 text-danger"></i>
        <span class="form-label" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><?php echo $red; ?></span>
    </div>
</div>

<div class="col-3 mx-auto text-center">
    <div class="row">
        <i class="bi bi-circle-fill fs-1" style="color:#9B26B6;"></i>
        <span class="form-label" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><?php echo $violet; ?></span>
    </div>
</div>

<div class="col-3 mx-auto text-center">
    <div class="row">
        <i class="bi bi-circle-fill fs-1 text-success"></i>
        <span class="form-label" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><?php echo $green; ?></span>
    </div>
</div>