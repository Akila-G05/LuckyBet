<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $session_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC");
    $session_data = $session_rs->fetch_assoc();

    $s_id = $session_data["id"] + 1;

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d");

    $admin = $_SESSION["au"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$admin["email"]."'");
    $admin_data = $admin_rs->fetch_assoc();


?>


<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>AdminPannel</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body style="font-family: Quicksand; background-color: #f3f3f3;" >

        <div class="container-fluid">
            <div class="row">

                <?php include "Adminslidebar.php"; ?>

                <div class="col-11 offset-2 offset-lg-1">
                    <div class="row">

                        <div class="col-11 mt-3 mx-auto" style="height:250px;">
                            <div class="row">

                                <div class="col-12 mt-2">
                                    <div class="row">

                                        <?php 
                                        
                                        $t_rs = Database::search("SELECT * FROM `transition_history` WHERE `status_id`='2'");
                                        $t_num = $t_rs->num_rows;

                                        $totalD = 0;
                                        $totalW = 0;
                                        $totalB = 0;

                                        for($m = 0; $m < $t_num; $m++){

                                            $t_data = $t_rs->fetch_assoc();

                                            if($t_data["t_type_id"] == 1){

                                                $totalD += $t_data["amount"];
                                                
                                            }else{

                                                $totalW += $t_data["amount"];

                                            }

                                        }

                                        $wallet_rs = Database::search("SELECT * FROM `b_wallet`");

                                        for($n = 0; $n < $wallet_rs->num_rows; $n++){

                                            $wallet_data = $wallet_rs->fetch_assoc();

                                            $totalB += $wallet_data["balance"];
                                        
                                        }

                                        $user_rs = Database::search("SELECT * FROM `user`");
                                        $user_num = $user_rs->num_rows;
                                        
                                        ?>

                                        <!-- Total Deposits -->
                                        <div class="col-3 mx-auto bg-white rounded rounded-2 mt-lg-0 mt-3" style="width: 250px;">
                                            <div class="row">

                                                <div class="col-8 mt-3">
                                                    <div class="row">
                                                        <span class="form-label fs-3" style="color: #fe9365;">$<?php echo number_format($totalD, 0); ?></span>
                                                        <span class="form-label" style="font-size: 13px; margin-top: -10px;">Total Deposits</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 mt-4 text-end">
                                                    <div class="row">
                                                        <span><i class="fa fa-usd fs-1 text-secondary" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end" style="background: linear-gradient(to right,#fe9365,#feb798); height: 45px;">
                                                    <div class="row">
                                                        <i class="fa fa-long-arrow-up text-white fs-4 mt-2" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <!-- Total Withdraws -->
                                        <div class="col-3 mx-auto bg-white rounded rounded-2 mt-lg-0 mt-3" style="width: 250px;">
                                            <div class="row">

                                                <div class="col-8 mt-3">
                                                    <div class="row">
                                                        <span class="form-label fs-3" style="color: #0ac282;">$<?php echo number_format($totalW, 0); ?></span>
                                                        <span class="form-label" style="font-size: 13px; margin-top: -10px;">Total Withdraws</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 mt-4 text-end">
                                                    <div class="row">
                                                        <span><i class="fa fa-usd fs-1 text-secondary" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end" style="background: linear-gradient(to right,#0ac282,#0df3a3); height: 45px;">
                                                    <div class="row">
                                                        <i class="fa fa-long-arrow-up text-white fs-4 mt-2" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <!-- Total AC Balance -->
                                        <div class="col-3 mx-auto bg-white rounded rounded-2 mt-lg-0 mt-3" style="width: 250px;">
                                            <div class="row">

                                                <div class="col-8 mt-3">
                                                    <div class="row">
                                                        <span class="form-label fs-3" style="color: #fe5d70;">$<?php echo number_format($totalB, 0); ?></span>
                                                        <span class="form-label" style="font-size: 13px; margin-top: -10px;">Total AC Balance</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 mt-4 text-end">
                                                    <div class="row">
                                                        <span><i class="fa fa-usd fs-1 text-secondary" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end" style="background: linear-gradient(to right,#fe5d70,#fe909d); height: 45px;">
                                                    <div class="row">
                                                        <i class="fa fa-long-arrow-up text-white fs-4 mt-2" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <!-- Users Count -->
                                        <div class="col-3 mx-auto bg-white rounded rounded-2 mt-lg-0 mt-3" style="width: 250px;">
                                            <div class="row">

                                                <div class="col-8 mt-3">
                                                    <div class="row">
                                                        <span class="form-label fs-3" style="color: #01a9ac;"><?php echo $user_num; ?></span>
                                                        <span class="form-label" style="font-size: 13px; margin-top: -10px;">Users Count</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 mt-4 text-end">
                                                    <div class="row">
                                                        <span><i class="fa fa-users fs-1 text-secondary" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end" style="background: linear-gradient(to right,#01a9ac,#01dbdf); height: 45px;">
                                                    <div class="row">
                                                        <i class="fa fa-long-arrow-up text-white fs-4 mt-2" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4 mb-3">
                                            <div class="row">

                                                <div class="col-12 mb-2 rounded rounded-2" style="background: linear-gradient(to right,#404E67,#404E67); ">
                                                    <div class="row">

                                                        <!-- Large -->
                                                        <div class="col-lg-3 d-none d-lg-block mt-2">
                                                            <div class="row">
                                                                <input class="d-none" type="text" value="<?php echo $s_id; ?>" id="sid">
                                                                <span class="form-label text-white fs-2 mx-4" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;" id="usid"><?php echo $session_data["id"]+ 1; ?></span>
                                                                <span class="form-label text-white fs-5 mx-4" style="font-family: 'Times New Roman', Times, serif; margin-top: -10px;"><?php echo $date ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-12 mt-2 text-center text-white">
                                                            <div class="row">

                                                                <input class="d-none" type="text" value="<?php echo $threeMinutesLater ?>" id="time">
                                                                <div id="countdown"></div>

                                                            </div>
                                                        </div>

                                                        <!-- Small -->
                                                        <div class="col-12 text-center  d-lg-none d-block mt-2">
                                                            <div class="row">
                                                                <input class="d-none" type="text" value="<?php echo $s_id; ?>" id="sid">
                                                                <span class="form-label text-white fs-2 mx-lg-4 mx-0" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;" id="usid"><?php echo $session_data["id"]+ 1; ?></span>
                                                                <span class="form-label text-white fs-5 mx-lg-4 mx-0" style="font-family: 'Times New Roman', Times, serif; margin-top: -10px;"><?php echo $date ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2  text-end mt-4 offset-lg-1 ">
                                                            <div class="row">
                                                                <div class="input-group input-group-sm mb-3 mt-2">
                                                                    <span class="input-group-text">$</span>
                                                                    <input type="number" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo $admin_data["bet_count"] ?>" id="betCount">
                                                                    <button class="btn btn-success" type="button" id="button-addon2" onclick="changeBetCount();">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                            
                                                <div class="col-5 mx-auto bg-white mb-3" style="height: 460px; width: 450px; border: #0ac282;">
                                                    <div class="row">

                                                        <div class="col-12 bg-white">
                                                            <div class="row">

                                                                <div class="col-12 mb-1" style="background-color: #01a9ac;">
                                                                    <div class="row">
                                                                        <span class="form-label text-white mt-2">Bets Details</span>
                                                                    </div>
                                                                </div>

                                                                <?php

                                                                    $bets_red_rs = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$s_id."' AND `color_id`='1'");
                                                                    $bets_red_num = $bets_red_rs->num_rows;

                                                                    $bets_violet_rs = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$s_id."' AND `color_id`='3'");
                                                                    $bets_violet_num = $bets_violet_rs->num_rows;

                                                                    $bets_green_rs = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$s_id."' AND `color_id`='2'");
                                                                    $bets_green_num = $bets_green_rs->num_rows;

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

                                                                <div class="col-12" >
                                                                    <div class="row" id="betDetails">
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
                                                                    </div>
                                                                </div>

                                                                <div class="col-12" style="background-color: #01a9ac;">
                                                                    <div class="row">
                                                                        <div class="col-6 mt-2 mb-2">
                                                                            <span class="form-label text-white mt-2">Custom Result</span>
                                                                        </div>
                                                                        <div class="col-6 mt-2 ">
                                                                            <div class="row">
                                                                                <div class="form-check form-switch offset-8">
                                                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 mb-3 mt-4">
                                                                    <div class="row">
                                                                        <span class="form-label text-dark">Select Number</span>
                                                                        <div class="col-12 mb-3">
                                                                            <div class="number-pad mx-auto text-white">
                                                                                <button class="number-button" data-value="0">0</button>
                                                                                <button class="number-button" data-value="1" style="background-color: #009664;">1</button>
                                                                                <button class="number-button" data-value="2" style="background-color: #FF4B4B;">2</button>
                                                                                <button class="number-button" data-value="3" style="background-color: #009664;">3</button>
                                                                                <button class="number-button" data-value="4" style="background-color: #FF4B4B;">4</button>
                                                                                <button class="number-button" data-value="5">5</button>
                                                                                <button class="number-button" data-value="6" style="background-color: #FF4B4B;">6</button>
                                                                                <button class="number-button" data-value="7" style="background-color: #009664;">7</button>
                                                                                <button class="number-button" data-value="8" style="background-color: #FF4B4B;">8</button>
                                                                                <button class="number-button" data-value="9" style="background-color: #009664;">9</button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-3 mt-5 offset-8">
                                                                            <div class="row">
                                                                                <button class="btn btn-sm rounded rounded-5 text-white fw-bold" id="investBtn" onclick="customResult();" style="background-color: #01a9ac;" >Confirm</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Table -->
                                                <div class="col-lg-7 col-12 mx-auto bg-white mb-3 overflow-auto" style="height: 460px;">
                                                    <div class="row">

                                                    <table class="table" >

                                                        <thead class=" rounded rounded-2">
                                                            <tr class="border border-2 rounded rounded-2 border-light text-white" style="font-family: monospace; background: linear-gradient(to right,#fe5d70,#fe909d);">
                                                                <th class="text-center text-white">Email</th>
                                                                <th class="text-center text-white">Invest</th>
                                                                <th class="text-center text-white">Join On</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="APBetsTable">

                                                            <?php
                                                            
                                                            $bets_rs = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$s_id."' AND `color_id`='0' ORDER BY `number` ASC");
                                                            $bets_num = $bets_rs->num_rows;

                                                            if($bets_num != 0){

                                                                for($x = 0; $x < $bets_num; $x++){

                                                                    $bets_data = $bets_rs->fetch_assoc();

                                                                ?>
                                                
                                                                    <tr class="text-dark text-dark justify-content-center bg-white" style="font-size: 12px; font-family: monospace; cursor: pointer;">
                                                                        <td class="text-center border-<?php if($bets_data["number"] % 2 == 0){ echo("danger"); }else{ echo("dark"); } ?>"><?php echo $bets_data["user_email"]; ?></td>
                                                                        <td class="text-center border-<?php if($bets_data["number"] % 2 == 0){ echo("danger"); }else{ echo("dark"); } ?>"><?php echo $bets_data["invest"]; ?></td>
                                                                        <td class="text-center border-<?php if($bets_data["number"] % 2 == 0){ echo("danger"); }else{ echo("dark"); } ?> fw-bold"><?php echo $bets_data["number"]; ?></td>
                                                                    </tr>

                                                                <?php
                                                                }
                                                            }else{
                                                                ?>
                                                                <tr class="text-dark text-dark justify-content-center bg-white" style="font-size: 12px; font-family: monospace; cursor: pointer;">
                                                                    <td class="text-center border-dark">....</td>
                                                                    <td class="text-center border-dark">No Bets</td>
                                                                    <td class="text-center border-dark">....</td>
                                                                </tr>
                                                            <?php
                                                            }

                                                            if($bets_violet_num != 0){
                                                        
                                                                for($c1 = 0; $c1 < $bets_violet_num; $c1++){

                                                                    $bets_violet_data = $bets_violet_rs->fetch_assoc();
                                                                    ?>
                                                                    <tr class="text-dark text-dark justify-content-center" style="font-size: 12px; font-family: monospace; cursor: pointer;">
                                                                        <td class="text-center border-dark"><?php echo $bets_violet_data["user_email"]; ?></td>
                                                                        <td class="text-center border-dark"><?php echo $bets_violet_data["invest"]; ?></td>
                                                                        <td class="text-center border-dark"><i class="bi bi-circle-fill" style="color:#9B26B6;"></i></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>

                                                            <?php
                                                            }

                                                            if($bets_red_num != 0){
                
                                                                for($c2 = 0; $c2 < $bets_red_num; $c2++){

                                                                    $bets_red_data = $bets_red_rs->fetch_assoc();
                                                                    ?>
                                                                    <tr class="text-dark text-dark justify-content-center" style="font-size: 12px; font-family: monospace; cursor: pointer;">
                                                                        <td class="text-center border-dark"><?php echo $bets_red_data["user_email"]; ?></td>
                                                                        <td class="text-center border-dark"><?php echo $bets_red_data["invest"]; ?></td>
                                                                        <td class="text-center border-dark"><i class="bi bi-circle-fill  text-danger"></i></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>

                                                            <?php
                                                            }

                                                            if($bets_green_num != 0){

                                                                for($c3 = 0; $c3 < $bets_green_num; $c3++){

                                                                    $bets_green_data = $bets_green_rs->fetch_assoc();
                                                                    ?>
                                                                    <tr class="text-dark text-dark justify-content-center" style="font-size: 12px; font-family: monospace; cursor: pointer;">
                                                                        <td class="text-center border-dark"><?php echo $bets_green_data["user_email"]; ?></td>
                                                                        <td class="text-center border-dark"><?php echo $bets_green_data["invest"]; ?></td>
                                                                        <td class="text-center border-dark"><i class="bi bi-circle-fill  text-success"></i></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>

                                                            <?php
                                                            }
                                                            ?>
                                                            

                                                        </tbody>


                                                    </table>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 mt-2 mb-4 overflow-auto bg-white" style="height: 460px;">
                                            <div class="row">

                                                <table class="table" >

                                                    <thead class=" rounded rounded-2">
                                                        <tr class="border border-2 rounded rounded-2 border-light text-white" style="font-family: monospace; background: linear-gradient(to right,#0ac282,#0df3a3);">
                                                            <th class="text-center text-white">Period</th>
                                                            <th class="text-center text-white">Price</th>
                                                            <th class="text-center text-white">Result</th>
                                                            <th class="text-center text-white">Bets</th>
                                                            <th class="text-center text-white"></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="">

                                                        <?php
                                                        if(isset($_GET["page"])){
                                                            $pageno = $_GET["page"];
                                                        }else{
                                                            $pageno = 1;
                                                        }

                                                        $session_rs2 = Database::search("SELECT `session`.`id` FROM `session` INNER JOIN `bets` ON `session`.`id`=`bets`.`session_id` GROUP BY `session`.`id`");
                                                        $session_num2 = $session_rs2->num_rows;

                                                        $results_per_page = 40;
                                                        $number_of_page = ceil($session_num2/$results_per_page);

                                                        $page_results = ($pageno - 1) * $results_per_page;

                                                        $selected_rs3 = Database::search("SELECT `session`.`id` FROM `session` INNER JOIN `bets` ON `session`.`id`=`bets`.`session_id` GROUP BY `session`.`id` ORDER BY `session`.`time` DESC LIMIT ".$results_per_page."");
                                                        $selected_num3 = $selected_rs3->num_rows;
                                                                                                
                                                        for($x = 0; $x < $selected_num3; $x++){
                                                            $selected_data3 = $selected_rs3->fetch_assoc();

                                                            $selected_rs = Database::search("SELECT * FROM `session` WHERE `id`='".$selected_data3["id"]."'");
                                                            $selected_data = $selected_rs->fetch_assoc();

                                                            $bets_rs2 = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$selected_data3["id"]."'");
                                                            $bets_num2 = $bets_rs2->num_rows;

                                                        ?>

                                                            <tr class="text-dark text-dark justify-content-center bg-white" style="font-size: 12px; font-family: monospace; cursor: pointer;">
                                                                <td class="text-center border-dark"><?php echo $selected_data["id"]; ?></td>
                                                                <td class="text-center border-dark"><?php echo $selected_data["price"]; ?></td>
                                                                <td class="text-center border-dark">
                                                                    <?php echo $selected_data["result"];

                                                                    if($selected_data["color_id"] == 1){
                                                                    ?>
                                                                        <i class="bi bi-circle-fill  text-danger"></i>
                                                                    <?php
                                                                    }else if($selected_data["color_id"] == 2){
                                                                    ?>
                                                                        <i class="bi bi-circle-fill text-success"></i>
                                                                    <?php
                                                                    }else if($selected_data["color_id"] == 3){
                                                                    ?>
                                                                        <i class="bi bi-circle-fill " style="color:#9B26B6;"></i>
                                                                    <?php
                                                                    }

                                                                    if($selected_data["color_id1"] == 3){
                                                                    ?>
                                                                        <i class="bi bi-circle-fill " style="color:#9B26B6;"></i>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td class="text-center border-dark"><?php echo $bets_num2; ?></td>
                                                                <td class="text-center border-dark fw-bold text-decoration-none">
                                                                    <a class="text-decoration-underline text-primary fw-bold" onclick="redirectToBetsDetails('<?php echo $selected_data['id']; ?>');">View</a>
                                                                </td>
                                                            </tr>

                                                        <?php
                                                        
                                                        
                                                        }
                                                        ?>
                                                        
                                                    </tbody>


                                                </table>

                                                <!-- pagination -->
                                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination pagination-sm justify-content-center">
                                                            <li class="page-item">

                                                                <a class="page-link" href="<?php if($pageno <= 1){
                                                                                                    echo("#");
                                                                                                }else{
                                                                                                    echo("?page=" . ($pageno - 1));
                                                                                                }  
                                                                                                ?>" aria-label="Previous">
                                                                    <span aria-hidden="true">&laquo;</span>
                                                                </a>

                                                                <?php
                                                                
                                                                for ($x = 1; $x <= $number_of_page; $x++) {
                                                                    if ($x == $pageno) {
                    
                                                                ?>
                                                                        <li class="page-item active">
                                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                        </li>
                                                                    <?php
                    
                                                                    } else {
                                                                    ?>
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                                        </li>
                                                                <?php
                                                                    }
                                                                }
                    
                                                                ?>


                                                                <a class="page-link" href="<?php if($pageno >= $number_of_page){
                                                                                                    echo("#");
                                                                                                }else{
                                                                                                    echo("?page=" . ($pageno + 1));
                                                                                                }  
                                                                                                ?>" aria-label="Next">
                                                                    <span aria-hidden="true">&raquo;</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <!-- pagination -->

                                            </div>
                                        </div>

                                        <!-- Toast -->
                                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                                            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="toast-header">
                                                
                                                    <strong class="me-auto">Alert</strong>
                                                    <!-- <small>11 mins ago</small> -->
                                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                                <div class="toast-body">
                                                    <span class="form-label text-success" id="msg">Success</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
        <script src="script2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>

</html>

<?php
}else{
    echo("You are not a Valid User");
    ?>
    <script>
        //window.location = "adminSignin.php";
    </script>
    <?php
}

?>