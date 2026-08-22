<?php

require "connection.php";

if(isset($_GET["page"])){
    $pageno = $_GET["page"];
}else{
    $pageno = 1;
}

$session_rs2 = Database::search("SELECT * FROM `session`");
$session_num2 = $session_rs2->num_rows;

$results_per_page = 20;

if(isset($_GET["more"])){
    $more = $_GET["more"];
    $results_per_page = $results_per_page + $more;
}

$number_of_page = ceil($session_num2/$results_per_page);

$page_results = ($pageno - 1) * $results_per_page;

$selected_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
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
