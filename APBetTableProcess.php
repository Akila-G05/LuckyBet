<?php
  
require "connection.php";

$session_rs = Database::search("SELECT * FROM `session` ORDER BY `time` DESC");
$session_data = $session_rs->fetch_assoc();

$s_id = $session_data["id"] + 1;
  
$bets_red_rs = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$s_id."' AND `color_id`='1'");
$bets_red_num = $bets_red_rs->num_rows;

$bets_violet_rs = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$s_id."' AND `color_id`='3'");
$bets_violet_num = $bets_violet_rs->num_rows;

$bets_green_rs = Database::search("SELECT * FROM `bets` WHERE `session_id`='".$s_id."' AND `color_id`='2'");
$bets_green_num = $bets_green_rs->num_rows;
        
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