<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $email = $_GET["email"];

    $totalInvest = 0;

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

                                <div class="col-12 my-4">
                                    <div class="row">

                                        <!-- Session Id -->
                                        <div class="col-6 bg-white rounded rounded-2">
                                            <div class="row">

                                                <?php
                                                
                                                $bets_rs = Database::search("SELECT * FROM `bets` ");
                                                $bets_num = $bets_rs->num_rows;

                                                for($z = 0; $z < $bets_num; $z++){

                                                    $bets_data = $bets_rs->fetch_assoc();

                                                    $result_rs = Database::search("SELECT * FROM `result` WHERE `bets_id`='".$bets_data["id"]."'");
                                                    $result_data = $result_rs->fetch_assoc();

                                                    $totalInvest =+ $bets_data["invest"];
                                                    $totalprofit =+ $result_data["profit"];

                                                }
                                                
                                                ?>

                                                <div class="col-8 mt-3">
                                                    <div class="row">
                                                        <span class="form-label fs-2" style="color: #fe9365;"><?php echo $email; ?></span>
                                                        <span class="form-label" style="font-size: 13px; margin-top: -10px;">Total Invest -> <?php echo number_format($totalInvest, 2); ?>$</span>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end" style="background: linear-gradient(to right,#fe9365,#feb798); height: 45px;">
                                                    <div class="row">
                                                        <i class="fa fa-long-arrow-up text-white fs-4 mt-2" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2 mt-3 overflow-auto bg-white" style="height: 460px;">
                                            <div class="row">

                                                <table class="table" >

                                                    <thead class=" rounded rounded-2">
                                                        <tr class="border border-2 rounded rounded-2 border-light text-white" style="font-family: monospace; background: linear-gradient(to right,#0ac282,#0df3a3);">
                                                            <th class="text-center text-white">Session</th>
                                                            <th class="text-center text-white">Invest</th>
                                                            <th class="text-center text-white">Price</th>
                                                            <th class="text-center text-white">Join On</th>
                                                            <th class="text-center text-white">Result</th>
                                                            <th class="text-center text-white">Profit</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="">

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

                                                        $selected_rs = Database::search("SELECT * FROM `bets` WHERE `user_email`='".$email."' ORDER BY `time` DESC");
                                                        $selected_num = $selected_rs->num_rows;

                                                        for($g = 0; $g < $selected_num; $g++){

                                                            $selected_data = $selected_rs->fetch_assoc();

                                                            $session_rs3 = Database::search("SELECT * FROM `session` WHERE `id`='".$selected_data["session_id"]."'");
                                                            $session_num3 = $session_rs3->num_rows;
                                                            $session_data3 = $session_rs3->fetch_assoc();

                                                            $result_rs = Database::search("SELECT * FROM `result` WHERE `bets_id`='".$selected_data["id"]."'");
                                                            $result_num = $result_rs->num_rows;
                                                            $result_data = $result_rs->fetch_assoc();

                                                        ?>

                                                            <tr class="text-dark text-dark justify-content-center bg-white" style="font-size: 12px; font-family: monospace; cursor: pointer;">
                                                                <td class="text-center border-dark"><?php echo $selected_data["session_id"]; ?></td>
                                                                <td class="text-center border-dark"><?php echo $selected_data["invest"]; ?></td>
                                                                <td class="text-center border-dark">
                                                                    <?php 
                                                                    if($session_num3 == 0){
                                                                        echo ("Pending..");
                                                                    }else{
                                                                        echo $session_data3["price"]; 
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="text-center border-dark">
                                                                    <?php
                                                                    if($selected_data["color_id"] == 0){
                                                                        if($selected_data["number"] != 10){
                                                                            echo $selected_data["number"];
                                                                        }
                                                                    }else{
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
                                                                    }
                                                                    ?> 
                                                                </td>
                                                                <td class="text-center border-dark">
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
                                                                <td class="text-center border-dark fw-bold text-decoration-none">
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
        window.location = "adminSignin.php";
    </script>
    <?php
}

?>