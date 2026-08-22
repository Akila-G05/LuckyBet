<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

$user =  $_SESSION["u"];

$wallet_rs = Database::search("SELECT * FROM `b_wallet` WHERE `user_email`='".$user["email"]."'");
$wallet_data = $wallet_rs->fetch_assoc();

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$user["email"]."'");
$user_data = $user_rs->fetch_assoc();

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
                                        
                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-lg-5 col-12 border border-3 border-white mx-auto text-center rou rounded-1">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-3 my-2 border border-3 border-white border-bottom-0 border-start-0 border-top-0">
                                                            <div class="row">
                                                                <i class="bi bi-person-bounding-box text-white mt-2" style="font-size: 50px;"></i>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-8 col-7 my-2 text-start mx-3">
                                                            <div class="row">
                                                                <span class="text-white fs-5"><?php echo $user_data["name"]; ?> <i class="bi bi-pencil-square" onclick="openCNModal()" style="cursor: pointer;"></i></span>

                                                                <span class="text-white fs-6 mt-1"><?php echo $user_data["email"]; ?></span>
                                                                <span class="text-white fs-6"><?php echo $user_data["mobile"]; ?></span> 

                                                                <span class="text-white fs-6 mt-1"><?php echo $user_data["v_code"]; ?> <i class="bi bi-clipboard-fill"></i></span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-5 col-12 mt-3 mt-lg-0 border border-3 border-white mx-auto text-center">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-4 my-lg-2 my-0 border border-3 border-white border-bottom-0 border-start-0 border-top-0">
                                                            <div class="row">
                                                                <span class="text-white mt-lg-4 mt-2" style="font-size: 35px;">$ <?php echo $wallet_data["balance"]; ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-8 col-6 my-2 text-start mx-3">
                                                            <div class="row">
                                                                <button class="btn btn-outline-light fw-bold mt-2" onclick="getDepositAddress();" >Deposit</button>
                                                                
                                                                <button class="btn btn-outline-light fw-bold mt-3 mb-2" onclick="openWModal();">Withdraw</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 mt-5">
                                    <div class="row">

                                        <div class="col-lg-5 col-11 text-center mx-auto">
                                            <div class="row">

                                                <span class="text-white fs-5">Deposist History</span>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <table class="table">

                                                            <thead>
                                                                <tr class="border border-2 rounded rounded-5 border-light text-white" style="font-family: monospace;">
                                                                    <th class="text-center text-white">No</th>
                                                                    <th class="text-center text-white">Amount</th>
                                                                    <th class="text-center text-white">Date</th>
                                                                </tr>
                                                            </thead>

                                                            <?php
                                                            
                                                            if(!empty($_SESSION["u"])){

                                                            ?>

                                                            <tbody id="">

                                                                <?php

                                                                $deposit_rs = Database::search("SELECT * FROM `transition_history` WHERE `user_email`='".$user["email"]."' AND `t_type_id`='1'");
                                                                $deposit_num = $deposit_rs->num_rows;

                                                                

                                                                for($x = 0; $x < $deposit_num; $x++){

                                                                    $deposit_data = $deposit_rs->fetch_assoc();


                                                                

                                                                ?>
                                                                

                                                                    <tr class="text-dark text-white" style="font-family: monospace;">
                                                                        <td class="text-center pt-2 border-white"><?php echo $x + 1; ?></td>
                                                                        <td class="text-center pt-2 border-white"><?php echo $deposit_data["amount"]; ?></td>
                                                                        <td class="text-center pt-2 border-white"><?php echo $deposit_data["date"] ?></td>
                                                                    </tr>

                                                                <?php

                                                                }

                                                                ?>

                                                            </tbody>

                                                            <?php
                                                            }
                                                            ?>

                                                        </table>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-11 mt-lg-0 mt-3 text-center mx-auto">
                                            <div class="row">

                                                <span class="text-white fs-5">Withdrawal History</span>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <table class="table">

                                                            <thead>
                                                                <tr class="border border-2 rounded rounded-5 border-light text-white" style="font-family: monospace;">
                                                                    <th class="text-center text-white">No</th>
                                                                    <th class="text-center text-white">Amount</th>
                                                                    <th class="text-center text-white">Date</th>
                                                                </tr>
                                                            </thead>

                                                            <?php
                                                            
                                                            if(!empty($_SESSION["u"])){

                                                            ?>

                                                            <tbody id="">

                                                                <?php

                                                                $withdraw_rs = Database::search("SELECT * FROM `transition_history` WHERE `user_email`='".$user["email"]."' AND `t_type_id`='2'");
                                                                $withdraw_num = $withdraw_rs->num_rows;

                                                                for($x = 0; $x < $withdraw_num; $x++){

                                                                    $withdraw_data = $withdraw_rs->fetch_assoc();


                                                                ?>
                                                                

                                                                    <tr class="text-dark text-white" style="font-family: monospace;">
                                                                        <td class="text-center pt-2 border-white"><?php echo $x + 1; ?></td>
                                                                        <td class="text-center pt-2 border-white"><?php echo $withdraw_data["amount"]; ?></td>
                                                                        <td class="text-center pt-2 border-white"><?php echo $withdraw_data["date"] ?></td>
                                                                    </tr>

                                                                <?php

                                                                }

                                                                ?>

                                                            </tbody>

                                                            <?php
                                                            }
                                                            ?>

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

                <!-- Name modal -->
                <div class="modal" tabindex="-1" id="nameModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="background-color: #000232;">

                            <div class="modal-body">    
                                <div class="row g-3">   
                                    <div class="col-12">
                                        <div class="input-group mb-4 mt-4 offset-1" style="width:380px;">
                                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="un">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-outline-primary fw-bold rounded rounded-5" onclick="changeuserName()">
                                    CHANGE
                                </button>
                                <!-- <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Cancel</button>                                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Name modal -->

                <!-- Withdraw modal -->
                <div class="modal" tabindex="-1" id="withdrawModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="background-color: #000232;">

                            <div class="modal-body">    
                                <div class="row g-3">   
                                    <div class="col-12">
                                        <div class="input-group mb-4 mt-4 offset-1" style="width:380px;">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" min="1" max="<?php echo $wallet_data["balance"]; ?>" step="1" value="1" id="priceW" onchange="setPrice('<?php echo $wallet_data['balance'] ?>');">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        <div class="input-group mb-4 mt-4 offset-1" style="width:380px;">
                                            <input type="text" class="form-control" placeholder="Withdraw Address" id="wAddress">
                                        </div>
                                        <small class="form-label text-white">
                                            The address to send the funds to, either this OR pbntag must be specified.
                                        </small>
                                        <small class="form-label text-success">
                                             Remember: this must be an address in currency's network
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-outline-primary fw-bold rounded rounded-5" onclick="createWithdrawal()">
                                    Confirm
                                </button>
                                <!-- <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Cancel</button>                                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Withdraw modal -->

                <!-- Deposit modal -->
                <div class="modal" tabindex="-1" id="depositModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="background-color: #000232;">

                            <div class="modal-body text-white">    
                                <div class="row g-3">   
                                    <div class="col-12" id="dAddress">
                                    Receiving.....
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button class="btn btn-outline-primary fw-bold rounded rounded-5" onclick="createWithdrawal()">
                                    Confirm
                                </button> -->
                                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Close</button>                                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Deposit modal -->

            </div>
        </div>
        
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>

    </body>

</html>

<?php

}else{
    ?>
    <script>
        alert("Please Signin Frist");
        window.location = "signin.php";
    </script>
    <?php
}

?>