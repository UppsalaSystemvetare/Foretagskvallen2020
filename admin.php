<?php
include("include/models/header.php");
include("include/html/default.php");
?>
    <body>
        <div class="container">
            <form method="post" action="include/models/sortingScript.php">
                <input type="text" name="number_of_spots"/>
                <button type="submit">Generate</button>
            </form>
            <form type="post" action="include/models/succesRatio.php">
                <button type="submit">Show success ratio</button>
            </form>
            <form method="post" action="include/models/check_assign.php">
                <button type="submit">Show stats</button>
            </form>
            <form type="post" action="include/models/testData.php">
                <button type="submit">Generate Test Data</button>
            </form>
        </div>

        <div class="foretag-wrapper">
            <div id="exTab1" class="container">	
                <ul class="nav nav-tabs">
                    <li class="nav-item active">
                        <a class="nav-link active" href="#1a" data-toggle="tab">Användares val</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#2a" data-toggle="tab">Tilldelade företag</a>
                    </li>
                </ul>

                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <table class="table table-striped table-bordered table-sm sortable" id="user-table">
                            <thead id="table-header">
                                <tr>
                                    <th id="sort-name" scope="col">Id</th>
                                    <th id="sort-rank" scope="col">Namn</th>
                                    <th id="sort-team" scope="col">Val (1 -> 5)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $connection = connect();
                                $query = "SELECT * FROM user_picks";
                                $result_users = $connection->query($query);

                                $query = "SELECT * FROM foretag";
                                $result_foretag = $connection->query($query);
                                $connection = disconnect();

                                $foretag_arr = [];

                                while($row = $result_foretag->fetch_assoc()){
                                    array_push($foretag_arr, $row["foretag_name"]);
                                }

                                while ($row = $result_users->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row["user_id"] ?></td>
                                        <td><?php echo $row["user_name"] ?></td>
                                        <td>
                                            <?php 
                                                $choice_arr = str_split($row["user_picks"]);
                                                $foretag_str = "";
                                                foreach($choice_arr as $val){
                                                    $foretag = $foretag_arr[$val-1];
                                                    $foretag_str = $foretag_str.$foretag.", ";
                                                }
                                                echo $foretag_str; 
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>  
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="2a">
                        <table class="table table-striped table-bordered table-sm sortable" id="user-table">
                            <thead id="table-header">
                                <tr>
                                    <?php 
                                        $connection = connect();
                                        $query = "SELECT * FROM foretag";
                                        $result_foretag = $connection->query($query);
                                        $connection = disconnect();
       
                                        while($row = $result_foretag->fetch_assoc()) { ?>
                                            <th><?php echo $row["foretag_name"] ?></th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $connection = connect();
                                $query = "SELECT p.user_name, f.foretag_name 
                                            FROM user_picks p
                                            JOIN assigned_to_user a ON p.user_id = a.user_id
                                            JOIN foretag f ON a.foretag_id = f.foretag_id";
                                $result = $connection->query($query);
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row["user_name"] ?></td>
                                        <td><?php echo $row["foretag_name"] ?></td>
                                    </tr>
                                <?php } ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
        </div>

   <!-- <div class="testData_button">
            <button type="button" class="btn btn-primary" onclick="generateTestData()">Generera testdata</button>
        </div> -->

    </body>
</html>
