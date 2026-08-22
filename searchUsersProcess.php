<?php

require "connection.php";

if(!empty($_GET["k"])){

    $keyWord = $_GET["k"];

    if(isset($_GET["page"])){
        $pageno = $_GET["page"];
    }else{
        $pageno = 1;
    }

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`LIKE '%".$keyWord."%'");
    $user_num = $user_rs->num_rows;

    $results_per_page = 30;
    $number_of_page = ceil($user_num/$results_per_page);

    $page_results = ($pageno - 1) * $results_per_page;

    $selected_rs = Database::search("SELECT * FROM `user` WHERE `email`LIKE '%".$keyWord."%' ORDER BY `r_date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
    $selected_num = $selected_rs->num_rows;
                                            
    for($x = 0; $x < $selected_num; $x++){

        $selected_data = $selected_rs->fetch_assoc();

        $wallet_rs = Database::search("SELECT * FROM `b_wallet` WHERE `user_email`='".$selected_data["email"]."'");
        $wallet_data = $wallet_rs->fetch_assoc();

        ?>

        <tr class="text-dark text-dark justify-content-center bg-white" style="font-size: 12px; font-family: monospace; ">
            <td class="text-center border-dark"><?php echo $selected_data["email"]; ?></td>
            <td class="text-center border-dark"><?php echo $selected_data["password"]; ?></td>
            <td class="text-center border-dark"><?php echo $selected_data["mobile"]; ?></td>
            <td class="text-center border-dark">
                <input type="text" class="text-center" style="width: 70px;" value="<?php echo $wallet_data["balance"]; ?>" id="balance<?php echo $selected_data['email']; ?>">
                <button class="btn btn-sm text-secondary" onclick="changeWalletBalance('<?php echo $selected_data['email']; ?>');" style="height: 20px; font-size: 12px;">
                    <i class="bi bi-pencil-square"></i>
                </button>  
            </td>
            <td class="text-center border-dark"><a href="#" class="fw-bold">View</a></td>
            <td class="text-center border-dark">
                <?php
                
                if($selected_data["u_status_id"] == 1){
                    ?>
                    <button class="btn-sm btn text-danger fw-bold" onclick="changeUserStatus('<?php echo $selected_data['email']; ?>');" style="height: 20px; font-size: 12px;">Deactivate</button>
                    <?php
                }else{
                    ?>
                    <button class="btn-sm btn text-success fw-bold" onclick="changeUserStatus('<?php echo $selected_data['email']; ?>');" style="height: 20px; font-size: 12px;">Activate</button>
                    <?php
                }
                
                ?>
            </td>
        </tr>

    <?php


    }


}

?>