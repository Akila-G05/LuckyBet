<?php

require "connection.php";

$session_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC");
$session_data = $session_rs->fetch_assoc();

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");
$date2 = $d->format("Y-m-d H:i:s");

$s_id = $session_data["id"] + 1;

session_start();

if(!empty($_SESSION["u"])){

$user =  $_SESSION["u"];

$wallet_rs = Database::search("SELECT * FROM `b_wallet` WHERE `user_email`='".$user["email"]."'");
$wallet_data = $wallet_rs->fetch_assoc();

}
?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="icon" href="resources/logo.jpeg"/> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>

    </head>
    <body style="background-color: #000232;">

        <div class="container-fluid">
            <div class="row">

                <?php include "header.php" ?>
                
                <div class="col-lg-12 mx-auto ">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-11 mx-auto">
                                    <div class="row">

                                        <div class="col-12 bg-secondary bg-opacity-25 mb-2" >
                                            <div class="row">

                                                <!-- Large -->
                                                <div class="col-lg-3 d-none d-lg-block mt-2">
                                                    <div class="row">
                                                        <input class="d-none" type="text" value="<?php echo $s_id; ?>" id="sid">
                                                        <span class="form-label text-white fs-2 mx-4" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;" id="usid"><?php echo $session_data["id"]+ 1; ?></span>
                                                        <span class="form-label text-white fs-5 mx-4" style="font-family: 'Times New Roman', Times, serif; margin-top: -10px;"><?php echo $date ?></span>
                                                        <input class="d-none" type="text" value="<?php echo $date2; ?>" id="date2">
                                                    </div>
                                                </div>

                                                

                                                <div class="col-lg-6 col-12 mt-2 text-center text-white">
                                                    <div class="row">

                                                        <input class="d-none" type="text" value="<?php echo $threeMinutesLater ?>" id="time">
                                                        <div id="countdown"></div>

                                                    </div>
                                                </div>

                                                

                                                <!-- <div class="col-3 text-end">
                                                    <div class="row">
                                                        <button disabled class="btn btn-outline-primary fw-bold rounded rounded-5" id="investBtn" style="width:200px; margin-top: 15px; margin-left: 50px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                            Join Colour
                                                        </button>
                                                        <button disabled class="btn btn-outline-warning fw-bold rounded rounded-5" id="investBtn2" style="width:200px; margin-top: 5px; margin-left: 50px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                                            Join Number
                                                        </button>
                                                    </div>
                                                </div> -->

                                                <div class="col-lg-3 col-12 text-lg-end text-center mt-lg-2 mt-0">
                                                    <div class="row">
                                                        <span class="text-white fw-bold">Bitcoin Price</span>
                                                        <div id="price-container" class=" fw-bold" style="font-size: 40px; margin-top: -10px; color: #FF4B4B;">
                                                                Loading...
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Small -->
                                                <div class="col-12 text-center  d-lg-none d-block mt-2">
                                                    <div class="row">
                                                        <input class="d-none" type="text" value="<?php echo $s_id; ?>" id="sid">
                                                        <span class="form-label text-white fs-2 " style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;" id="usid"><?php echo $session_data["id"]+ 1; ?></span>
                                                        <span class="form-label text-white fs-5 " style="font-family: 'Times New Roman', Times, serif; margin-top: -10px;"><?php echo $date ?></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-12" style="width:800; height:400;">
                                            <div class="row">

                                                <div class="col-12  bg-secondary bg-opacity-25" style="width: 800px; height: 400px;">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-11 mx-auto mt-1">
                                                            <div class="row">

                                                                <div class="col-12 mt-4">
                                                                    <div class="row">

                                                                        <span class="form-label text-white fs-3 fw-bold text-center mb-3">SELECT</span>
                                                                        <div class="col-12 mx-auto mb-3" style="margin-top: -10px;">
                                                                            <div class="form-check form-check-inline offset-1">
                                                                                <label class="form-check-label" for="inlineRadio1">
                                                                                    <i class="bi bi-circle-fill text-danger " style="font-size: 40px;" onclick="colorModal('inlineRadio1')"></i>
                                                                                    <input class="form-check-input mt-4 " type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline offset-1">
                                                                                <label class="form-check-label" for="inlineRadio2">
                                                                                    <i class="bi bi-circle-fill" style="color:#9B26B6; font-size: 40px;" onclick="colorModal('inlineRadio2')"></i>
                                                                                    <input class="form-check-input mt-4 " type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline offset-1">
                                                                                <label class="form-check-label" for="inlineRadio3">
                                                                                    <i class="bi bi-circle-fill text-success " style="font-size: 40px;" onclick="colorModal('inlineRadio3')"></i>
                                                                                    <input class="form-check-input mt-4 " type="radio" name="inlineRadioOptions" id="inlineRadio3" value="2">
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        

                                                                        <span class="form-label text-white fs-3 fw-bold text-center mb-4">OR</span>

                                                                        <div class="col-12">
                                                                            <div class="row">

                                                                                <!-- <span class="form-label text-white">Select Number</span>  -->
                                                                                <div class="col-12 mb-4">
                                                                                    <div class="number-pad mx-auto text-white">
                                                                                        <button class="number-button" data-value="0" onclick="numberModal(0);">0</button>
                                                                                        <button class="number-button" data-value="1" style="background-color: #009664;" onclick="numberModal(1);">1</button>
                                                                                        <button class="number-button" data-value="2" style="background-color: #FF4B4B;" onclick="numberModal(2);">2</button>
                                                                                        <button class="number-button" data-value="3" style="background-color: #009664;" onclick="numberModal(3);">3</button>
                                                                                        <button class="number-button" data-value="4" style="background-color: #FF4B4B;" onclick="numberModal(4);">4</button>
                                                                                        <button class="number-button" data-value="5" onclick="numberModal(5);">5</button>
                                                                                        <button class="number-button" data-value="6" style="background-color: #FF4B4B;" onclick="numberModal(6);">6</button>
                                                                                        <button class="number-button" data-value="7" style="background-color: #009664;" onclick="numberModal(7);">7</button>
                                                                                        <button class="number-button" data-value="8" style="background-color: #FF4B4B;" onclick="numberModal(8);">8</button>
                                                                                        <button class="number-button" data-value="9" style="background-color: #009664;" onclick="numberModal(9);">9</button>
                                                                                    
                                                                                    </div>
                                                                                </div>

                                                                                <hr>

                                                                                <!-- <span class="form-label text-white">Select Price</span>
                                                                                <div class="col-12">
                                                                                    <div class="input-group mb-4 offset-1" style="width:380px;">
                                                                                        <span class="input-group-text">$</span>
                                                                                        <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" min="1" max="<?php echo $wallet_data["balance"]; ?>" step="1" value="1" id="price2" onchange="setPrice2('<?php echo $wallet_data['balance'] ?>');">
                                                                                        <span class="input-group-text">.00</span>
                                                                                    </div>
                                                                                </div> -->

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

                                        <div class="col-8 text-white d-lg-block d-none">
                                            <div class="row">

                                                <div id="chart-container"></div>

                                            </div>
                                        </div>

                                        <div class="col-8 text-white d-block d-lg-none mt-3" style="margin-right: 50px;">
                                            <div class="row">

                                                <div id="chart-container2"></div>

                                            </div>
                                        </div>

                                        <div class="col-12 mt-4 overflow-auto text-center justify-content-center">
                                            <div class="row justify-content-center">

                                            <div class="w3-row text-white fw-bold offset-lg-1" style="width: 400px; ">
                                                <a href="javascript:void(0)" onclick="openCity(event, 'London');">
                                                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">Order</div>
                                                </a>
                                                <a href="javascript:void(0)" onclick="openCity(event, 'Paris');">
                                                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">History</div>
                                                </a>
                                                <!-- <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo');">
                                                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">....</div>
                                                </a> -->
                                            </div>

                                            <!-- bets -->
                                            <div id="London" class="w3-container city" style=" height: 600px;">
                                                <div class="row mt-3">
                                                    <table class="table">

                                                        <thead>
                                                            <tr class="border border-2 rounded rounded-5 border-light text-white" style="font-family: monospace;">
                                                                <th class="text-center text-white">Period</th>
                                                                <th class="text-center text-white">Invest</th>
                                                                <th class="text-center text-white">Join On</th>
                                                                <th class="text-center text-white">Price</th>
                                                                <th class="text-center text-white">Result</th>
                                                                <th class="text-center text-white">Profit</th>
                                                            </tr>
                                                        </thead>

                                                        <?php
                                                        
                                                        if(!empty($_SESSION["u"])){

                                                        ?>

                                                        <tbody id="betsHistory">

                                                            <?php

                                                            if(isset($_GET["page"])){
                                                                $pageno = $_GET["page"];
                                                            }else{
                                                                $pageno = 1;
                                                            }

                                                            $bets_rs2 = Database::search("SELECT * FROM `bets` ");
                                                            $bets_num2 = $bets_rs2->num_rows;

                                                            $results_per_page = 30;
                                                            $number_of_page = ceil($bets_num2/$results_per_page);

                                                            $page_results = ($pageno - 1) * $results_per_page;

                                                            $bets_rs = Database::search("SELECT * FROM `bets` WHERE `user_email`='".$user["email"]."' ORDER BY `time` DESC LIMIT ".$results_per_page."");
                                                            $bets_num = $bets_rs->num_rows;

                                                            for($g = 0; $g < $bets_num; $g++){

                                                                $bets_data = $bets_rs->fetch_assoc();

                                                                $session_rs3 = Database::search("SELECT * FROM `session` WHERE `id`='".$bets_data["session_id"]."'");
                                                                $session_num3 = $session_rs3->num_rows;
                                                                $session_data3 = $session_rs3->fetch_assoc();

                                                                $result_rs = Database::search("SELECT * FROM `result` WHERE `bets_id`='".$bets_data["id"]."'");
                                                                $result_num = $result_rs->num_rows;
                                                                $result_data = $result_rs->fetch_assoc();

                                                            ?>
                                                            

                                                                <tr class="text-dark text-white" style="font-family: monospace;">
                                                                    <td class="text-center pt-2 border-white"><?php echo $bets_data["session_id"]; ?></td>
                                                                    <td class="text-center pt-2 border-white"><?php echo $bets_data["invest"]; ?></td>
                                                                    <td class="text-center pt-2 border-white">
                                                                        <?php
                                                                        if($bets_data["color_id"] == 0){
                                                                            if($bets_data["number"] != 10){
                                                                                echo $bets_data["number"];
                                                                            }
                                                                        }else{
                                                                            if($bets_data["color_id"] == 1){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6 text-danger"></i>
                                                                            <?php
                                                                            }else if($bets_data["color_id"] == 2){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6 text-success"></i>
                                                                            <?php
                                                                            }else if($bets_data["color_id"] == 3){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6" style="color:#9B26B6;"></i>
                                                                            <?php
                                                                            }
                                                                        }
                                                                        ?>    
                                                                    </td>
                                                                    <td class="text-center pt-2 border-white">
                                                                        <?php 
                                                                        if($session_num3 == 0){
                                                                            echo ("Pending..");
                                                                        }else{
                                                                            echo $session_data3["price"]; 
                                                                        }
                                                                        ?>   
                                                                    </td>
                                                                    <td class="text-center pt-2 border-white">
                                                                        <?php
                                                                        if($session_num3 == 0){
                                                                            echo ("Pending..");
                                                                        }else{
                                                                           echo $session_data3["result"];

                                                                          
                                                                            if($session_data3["color_id"] == 1){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6 text-danger"></i>
                                                                            <?php
                                                                            }else if($session_data3["color_id"] == 2){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6 text-success"></i>
                                                                            <?php
                                                                            }else if($session_data3["color_id"] == 3){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6" style="color:#9B26B6;"></i>
                                                                            <?php
                                                                            }

                                                                            if($session_data3["color_id1"] == 3){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6" style="color:#9B26B6;"></i>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center pt-2 border-white">
                                                                        <?php
                                                                        if($result_num == 0){
                                                                            echo("Pending...");
                                                                        }else{
                                                                            echo $result_data["profit"];
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>

                                                            <?php

                                                            }

                                                            ?>
                                                            
                                                            <!-- <tr class="text-dark text-white justify-content-center" style="font-family: monospace; cursor: pointer;">
                                                                <td class="text-center pt-2 border-white"></td>
                                                                <td class="text-center pt-2 border-white"></td>
                                                                <td class="text-center pt-2 border-white"></td>
                                                                <td class="text-center pt-2 border-white"></td>
                                                                <td class="text-center pt-2 border-white"></td>
                                                            </tr> -->

                                                        </tbody>

                                                        <?php
                                                        }
                                                        ?>

                                                    </table>
                                                    
                                                </div>
                                            </div>

                                            <!-- session -->
                                            <div id="Paris" class="w3-container city" style="display:none; height: 600px;">
                                                <div class="col-12">
                                                    <div class="row mt-3">
                                                        <table class="table">

                                                            <thead>
                                                                <tr class="border border-2 rounded rounded-5 border-light text-white" style="font-family: monospace;">
                                                                    <th class="text-center text-white">Period</th>
                                                                    <th class="text-center text-white">Price</th>
                                                                    <th class="text-center text-white">Result</th>
                                                                </tr>
                                                            </thead>


                                                            <tbody id="history">
                                                                <?php
                                                                if(isset($_GET["page"])){
                                                                    $pageno = $_GET["page"];
                                                                }else{
                                                                    $pageno = 1;
                                                                }

                                                                $session_rs2 = Database::search("SELECT * FROM `session`");
                                                                $session_num2 = $session_rs2->num_rows;

                                                                $results_per_page = 30;
                                                                $number_of_page = ceil($session_num2/$results_per_page);

                                                                $page_results = ($pageno - 1) * $results_per_page;

                                                                $selected_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC LIMIT ".$results_per_page."");
                                                                $selected_num = $selected_rs->num_rows;
                                                                                                        
                                                                for($x = 0; $x < $selected_num; $x++){
                                                                    $selected_data = $selected_rs->fetch_assoc();
                                                                ?>

                                                                    <tr class="text-dark text-white justify-content-center" style="font-family: monospace;">
                                                                        <td class="text-center pt-2 border-white"><?php echo $selected_data["id"]; ?></td>
                                                                        <td class="text-center pt-2 border-white"><?php echo $selected_data["price"]; ?></td>
                                                                        <td class="text-center pt-2 border-white">
                                                                            <?php echo $selected_data["result"]; ?> 

                                                                            <?php 
                                                                            if($selected_data["color_id"] == 1){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6 text-danger"></i>
                                                                            <?php
                                                                            }else if($selected_data["color_id"] == 2){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6 text-success"></i>
                                                                            <?php
                                                                            }else if($selected_data["color_id"] == 3){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6" style="color:#9B26B6;"></i>
                                                                            <?php
                                                                            }

                                                                            if($selected_data["color_id1"] == 3){
                                                                            ?>
                                                                                <i class="bi bi-circle-fill fs-6" style="color:#9B26B6;"></i>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                    </tr>   

                                                                <?php
                                                                }
                                                                ?>

                                                                    <tr class="text-dark text-white justify-content-center" onclick="loadHistory();" style="font-family: monospace; cursor: pointer;">
                                                                        <td class="text-center pt-2 border-white"></td>
                                                                        <td class="text-center pt-2 border-white">Load More...</td>
                                                                        <td class="text-center pt-2 border-white"></td>
                                                                    </tr>
                                                            </tbody>

                                                        </table>
                                                        
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

                 <!-- colour modal -->
                 <div class="modal" tabindex="-1" id="colourModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="background-color: #000232;">

                            <div class="modal-body">    
                                <div class="row g-3">   
                                    <div class="col-12">
                                        <div class="input-group  mb-4 mt-4  " >
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" min="1" max="<?php echo $wallet_data["balance"]; ?>" step="1" value="1" id="price" onchange="setPrice('<?php echo $wallet_data['balance'] ?>');">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button disabled class="btn btn-outline-primary fw-bold rounded rounded-5" id="investBtn" onclick="joinColor()">
                                    JOIN
                                </button>
                                <!-- <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Cancel</button>                                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- colour modal -->

                <!-- Number modal -->
                <div class="modal" tabindex="-1" id="numberModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="background-color: #000232;">

                            <div class="modal-body">    
                                <div class="row g-3">   
                                    <div class="col-12">
                                        <div class="input-group mb-4 mt-4 " >
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" min="1" max="<?php echo $wallet_data["balance"]; ?>" step="1" value="1" id="price2" onchange="setPrice2('<?php echo $wallet_data['balance'] ?>');">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button disabled class="btn btn-outline-primary fw-bold rounded rounded-5" id="investBtn2" onclick="joinNumber()">
                                    JOIN
                                </button>
                                <!-- <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Cancel</button>                                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Number modal -->



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
        
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
        
        <!-- BTC/USDT Chart -->
        <script type="text/javascript">
            // Define your Binance API key and secret
            const apiKey = '9NM5JS1Eiz7BPXtuCTehKEStAOiBxhAfd25piJkVGXxklF7Q75q9jSZqu4037s0g';
            const apiSecret = 'hNuyGHWkOasi42QnvvgUbVcOaCFp5WiWksnm8ddwpunQBLLeqF6gJf46K1hJwrFd';

            // Initialize the TradingView widget
            new TradingView.widget({
                container_id: "chart-container",
                width: 800,
                height: 400,
                symbol: "BINANCE:BTCUSDT",
                interval: "1", // Adjust the interval as needed (e.g., 1D for daily)
                timezone: "Etc/UTC",
                theme: "dark",
                style: "1",
                locale: "en",
                toolbar_bg: "#f1f3f6",
                enable_publishing: false,
                allow_symbol_change: false,
                save_image: false,
                hideideas: true,
            });

            new TradingView.widget({
                container_id: "chart-container2",
                width: 350,
                height: 400,
                symbol: "BINANCE:BTCUSDT",
                interval: "1", // Adjust the interval as needed (e.g., 1D for daily)
                timezone: "Etc/UTC",
                theme: "dark",
                style: "1",
                locale: "en",
                toolbar_bg: "#f1f3f6",
                enable_publishing: false,
                allow_symbol_change: false,
                save_image: false,
                hideideas: true,
            });
        </script>


    </body>

</html>

