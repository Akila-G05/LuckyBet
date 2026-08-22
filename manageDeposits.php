<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

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

                <div class="col-lg-11 col-11 offset-1 offset-lg-1">
                    <div class="row">

                        <div class="col-11 mt-4 mx-auto" style="height:250px;">
                            <div class="row">

                            <div class="col-12">
                                <div class="row">

                                <div class="col-11 mx-4">
                                    <div class="row">

                                        <div class="col-12 mt-4 mb-4" >
                                            <div class="row">
                                                <div class="col-lg-8 col-8 mt-2 offset-lg-1 offset-0 ">
                                                    <input type="text" class="form-control form-control-sm border-1 border-dark" placeholder="Enter Email..." id="text" style="cursor: pointer;">
                                                </div>
                                                <div class="col-2 mt-2 d-grid">
                                                    <button class="btn btn-sm btn-outline-primary rounded rounded-5" onclick="findusers()">Search</button style="cursor: pointer;">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">

                                            <div class="col-12 mt-2 mt-3 overflow-auto bg-white" style="height: 460px;">
                                                <div class="row">

                                                    <table class="table" >

                                                        <thead class=" rounded rounded-2">
                                                            <tr class="border border-2 rounded rounded-2 border-light text-white" style="font-family: monospace; background: linear-gradient(to right,#0ac282,#0df3a3);">
                                                                <th class="text-center text-white">Email</th>
                                                                <th class="text-center text-white">Amount</th>
                                                                <th class="text-center text-white">Date</th>
                                                                <th class="text-center text-white">Status</th>
                                                                <th class="text-center text-white"></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="loadusers">

                                                            <?php
                                                           
                                                            if(isset($_GET["page"])){
                                                                $pageno = $_GET["page"];
                                                            }else{
                                                                $pageno = 1;
                                                            }

                                                            $w_rs = Database::search("SELECT * FROM `transition_history` WHERE `t_type_id`='1'");
                                                            $w_num = $w_rs->num_rows;

                                                            $results_per_page = 30;
                                                            $number_of_page = ceil($w_num/$results_per_page);

                                                            $page_results = ($pageno - 1) * $results_per_page;

                                                            $selected_rs = Database::search("SELECT * FROM `transition_history` WHERE `t_type_id`='1' ORDER BY `date`");
                                                            $selected_num = $selected_rs->num_rows;
                                                                                                    
                                                            for($x = 0; $x < $selected_num; $x++){

                                                                $selected_data = $selected_rs->fetch_assoc();

                                                            ?>

                                                                <tr class="text-dark text-dark justify-content-center bg-white" style="font-size: 12px; font-family: monospace; ">
                                                                    <td class="text-center border-dark"><?php echo $selected_data["user_email"]; ?></td>
                                                                    <td class="text-center border-dark"><?php echo $selected_data["amount"]; ?></td>
                                                                    <td class="text-center border-dark"><?php echo $selected_data["date"]; ?></td>
                                                                    <td class="text-center border-dark">
                                                                        <?php
                                                                        
                                                                        if($selected_data["status_id"] == 1){
                                                                            echo("Pending..");
                                                                        }else if($selected_data["status_id"] == 2){
                                                                            echo("Success");
                                                                        }else{
                                                                            echo("Pending");
                                                                        }
                                                                        
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center border-dark"></td>
                                                                </tr>

                                                            <?php
                                                            
                                                            
                                                            }
                                                            ?>
                                                            
                                                        </tbody>


                                                    </table>

                                                </div>
                                            </div>

                                            <!-- pagination -->
                                            <!-- <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
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
                                            </div> -->
                                            <!-- pagination -->

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
        window.location = "adminSignin.php";
    </script>
    <?php
}

?>