<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resource/logo1.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>
        
        <div class="col-12">
            <div class="row mt-3">

                <div class="col-lg-3 col-6 offset-1 mt-2">
                    <?php 
                    if(!empty($user)){
                        ?>
                        <span class="text-lg-start text-white"><b>Welcome </b><?php echo $user["name"] ?></span> |
                        <span class="text-lg-start fw-bold text-white">Sign Out</span> |
                        <?php
                    }else{
                        ?>
                        <a href="signup.php" class="text-decoration-none fw-bold">Register</a>
                        <?php
                    }
                    ?>
                </div>

                <div class="col-4 text-center mt-2 list-unstyled list1 ">
                    <ul class="list-unstyled">
                        <li><a class="text-decoration-none text-white" style="font-size: 20px;" href="index.php"><i class="bi bi-house"></i></a></li>
                        <li><a class="text-decoration-none text-white" style="font-size: 20px;" href="withdraw.php"><i class="bi bi-currency-dollar"></i></a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-12 mt-2 text-lg-end text-center mb-lg-0 mb-2">
                    <?php 
                    if(!empty($user)){
                        ?>
                        <span class="text-lg-start text-white" id="wBalance" style="font-size: 20px;"><b>$ </b><?php echo number_format($wallet_data["balance"], 1) ?></span> 
                        <?php
                    }else{
                        ?>
                        <span class="text-lg-start text-white" style="font-size: 20px;"><b>$ </b>0  </span> 
                        <?php
                    }
                    ?>
                    
                    <span class="text-lg-start text-white" style="font-size: 20px;"> <i class="bi bi-wallet"></i></span> 
                </div>

            </div>
        </div>

        <hr class="mt-lg-2 text-white"/>

    </body>

</html>