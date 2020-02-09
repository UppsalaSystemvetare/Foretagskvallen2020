<?php
include("include/models/header.php");
include("include/html/default.php");
include("include/models/users.php");

if(!isset($_SESSION['user']) || !isset($_SESSION['rank']) || $_SESSION['rank'] < 4){
    header("Location: login.php");
}

?>
    <body class="admin-body">
        <div class="container admin-controls">
            <h1>Controls</h1>
            <div class="row">
                <div class="col">
                    <form method="post" action="include/models/sortingScript.php">
                        <div class="form-group">
                            <label for="number_of_spots">Antal platser per företag</label>
                            <input type="text" class="form-control" name="number_of_spots" placeholder="20" required/>
                            <small id="emailHelp" class="form-text">Platserna måste räcka åt alla anmälda! (Platser/per företag * företag > antal anmälda)</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Generera val åt alla (<?php echo Users::get_nr_of_users();?>) användare</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form type="post" action="include/models/succesRatio.php">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Visa nöje/missnöje</button>
                        </div>
                    </form>
                    <form method="post" action="include/models/check_assign.php">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Visa val per företag</button>
                        </div>
                    </form>
                    <form type="post" action="include/models/testData.php">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Generate Testdata</button>
                        </div>
                    </form>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#AlertModal">Ta bort alla anmälda</button>
                    </div>
                </div>

                <div class="modal fade" id="AlertModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="black">Är du säker på att du vill ta bort ALLA Användare och deras val?</p>
                            </div>
                            <div class="modal-footer">
                                <form type="post" action="include/models/remove_users.php">
                                    <button type="button" class="btn btn-danger" aria-label="Close" data-dismiss="modal">
                                        JA - TA BORT ALLA
                                    </button>
                                </form>
                                <button type="button" class="btn btn-primary" aria-label="Close" data-dismiss="modal">
                                    NEJ
                                </button>
                            </div>
                        </div> 
                    </div>    
                </div>

            </div>           
        </div>
        <div class="container admin-tables">
            <h1>Tabeller </h1>
            <div id="exTab1" class="container">	
                <ul class="nav nav-tabs">
                    <li class="nav-item active">
                        <a class="nav-link active" href="#1a" data-toggle="tab">Användares val</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#2a" data-toggle="tab">Tilldelade företag</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#3a" data-toggle="tab">Hantera företag</a>
                    </li>
                </ul>

                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <div class="container admin-tables-column">
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
                    </div>
                    <div class="tab-pane" id="2a">
                        <div class="container admin-tables-column">
                            <div class="row">
                                <?php 
                                    $connection = connect();
                                    $query = "SELECT * FROM foretag";
                                    $result_foretag = $connection->query($query);
                                    $connection = disconnect();

                                    while($row = $result_foretag->fetch_assoc()) { ?>
                                        <div class="col-sm">
                                            <table class="table table-striped table-bordered table-sm sortable">
                                                <th><?php echo $row["foretag_name"] ?></th>

                                                <?php
                                                $result = Users::get_users_on_foretag($row["foretag_id"]);
                                                while ($row = $result->fetch_assoc()) { ?>
                                                    <tr><td><?php echo $row["user_name"] ?></td></tr>
                                                <?php } ?>  

                                            </table>
                                        </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="3a">
                        <div class="container admin-tables-column">
                            sup - under konstruktion
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
