<?php

require "connection.php";

session_start();

if(!empty($_SESSION["u"])){

    $user = $_SESSION["u"];

        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }

        $bets_rs2 = Database::search("SELECT * FROM `bets`");
        $bets_num2 = $bets_rs2->num_rows;

        $results_per_page = 30;
        $number_of_page = ceil($bets_num2 / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;

        $bets_rs = Database::search("SELECT * FROM `bets` WHERE `user_email`='" . $user["email"] . "' ORDER BY `time` DESC LIMIT " . $results_per_page . "");
        $bets_num = $bets_rs->num_rows;

        for ($g = 0; $g < $bets_num; $g++) {

            $bets_data = $bets_rs->fetch_assoc();

            $session_rs3 = Database::search("SELECT * FROM `session` WHERE `id`='" . $bets_data["session_id"] . "'");
            $session_num3 = $session_rs3->num_rows;
            $session_data3 = $session_rs3->fetch_assoc();

            $result_rs = Database::search("SELECT * FROM `result` WHERE `bets_id`='" . $bets_data["id"] . "'");
            $result_num = $result_rs->num_rows;
            $result_data = $result_rs->fetch_assoc();

        ?>


            <tr class="text-dark text-white" style="font-family: monospace;">
                <td class="text-center pt-2 border-white"><?php echo $bets_data["session_id"]; ?></td>
                <td class="text-center pt-2 border-white"><?php echo $bets_data["invest"]; ?></td>
                <td class="text-center pt-2 border-white">
                    <?php
                    if ($bets_data["color_id"] == 0) {
                        if ($bets_data["number"] != 10) {
                            echo $bets_data["number"];
                        }
                    } else {
                        if ($bets_data["color_id"] == 1) {
                    ?>
                            <i class="bi bi-circle-fill fs-6 text-danger"></i>
                        <?php
                        } else if ($bets_data["color_id"] == 2) {
                        ?>
                            <i class="bi bi-circle-fill fs-6 text-success"></i>
                        <?php
                        } else if ($bets_data["color_id"] == 3) {
                        ?>
                            <i class="bi bi-circle-fill fs-6" style="color:#9B26B6;"></i>
                    <?php
                        }
                    }
                    ?>
                </td>
                <td class="text-center pt-2 border-white">
                    <?php
                    if ($session_num3 == 0) {
                        echo ("Pending..");
                    } else {
                        echo $session_data3["price"];
                    }
                    ?>
                </td>
                <td class="text-center pt-2 border-white">
                    <?php
                    if ($session_num3 == 0) {
                        echo ("Pending..");
                    } else {
                        echo $session_data3["result"];


                        if ($session_data3["color_id"] == 1) {
                    ?>
                            <i class="bi bi-circle-fill fs-6 text-danger"></i>
                        <?php
                        } else if ($session_data3["color_id"] == 2) {
                        ?>
                            <i class="bi bi-circle-fill fs-6 text-success"></i>
                        <?php
                        } else if ($session_data3["color_id"] == 3) {
                        ?>
                            <i class="bi bi-circle-fill fs-6" style="color:#9B26B6;"></i>
                        <?php
                        }

                        if ($session_data3["color_id1"] == 3) {
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
                    if ($result_num == 0) {
                        echo ("Pending...");
                    } else {
                        echo $result_data["profit"];
                    }
                    ?>
                </td>
            </tr>

        <?php

        }

        ?>

<?php
}else{
    echo("Please Signin Frist");
}
?>