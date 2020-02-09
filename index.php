<?php
include("include/html/default.php");
include("include/models/header.php");
include("include/models/users.php");
?>
    <body onload="init();">
        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-dialog-lg" role="document">
                <div class="modal-content">

                <div class="modal-body">
                    <div class="container-md">
                        <h1>Välkommen till företagskvällen!</h1>
                        <div class="intro-text">
                            <p>För att vi ska kunna placera dig hos ett företag behöver vi veta vad du heter. 
                                Skriv in ditt för- och efternamn och tryck sen på "Gå vidare"!
                            </p>
                        </div>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="InputName" placeholder="Namn exempelsson">
                                <small id="emailHelp" class="form-text text-muted">Ange ditt för- och efternamn.</small>
                            </div>
                        </form>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="contbutton">Gå vidare</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="foretag-wrapper">
            <div class="info">
                <div class="name-holder">
                    <p class="small">Anmäld som:</p>
                    <h1 class="shadowed"><div class="h1" id="nametag"><?php if(isset($_SESSION['name']) && !empty($_SESSION['name'])) { echo $_SESSION['name']; } ?></div></h1>
                </div>
                
            
                <h2>Dags att välja företag!</h2>
                <div class="intro-text">
                    <p>
                    Flytta runt de 5 företagen och placera de du helst vill besöka högst upp! 
                    Du kan flytta runt dem hur många gånger som helst
                    under presentationerna och du kommer att förvarnas innan
                    valen blir låsta. Om du av någon anledning skulle stänga ner sidan eller på annat sätt tappa ditt 
                    inskrivna namn kan du skriva EXAKT samma igen för att undvika dubletter för oss :)
                    </p>
                </div>

                <div class="foretag-list p-3 border bg-light">

                    <p class="small-p">Dra och släpp företagen i önskad ordning.</p>

                    <?php
                    $connection = connect();
                    $query = "SELECT * FROM foretag";
                    $result_foretag = $connection->query($query);
                    $connection = disconnect();
                    ?>

                    <ul id="draggablePanelList" class="list-unstyled">
                        <?php 
                            $i = 1;
                            while($row = $result_foretag->fetch_assoc()) { ?>
                                <li class="panel panel-info"><div class="foretag p-3 border bg-light panel-heading" id="<?php echo $i?>"><?php echo $row["foretag_name"]?></div></li>
                                <?php 
                                $i = $i + 1; 
                            }?>
                    </ul>

                </div>
                <div class="submit_holder">
                    <button type="button" class="btn btn-primary" onclick="updateUserChoice()">Uppdatera val</button>
                </div>
            </div>

            <?php 
            if(isset($_SESSION['name'])){

                $result = Users::get_user_foretag_on_name($_SESSION['name']);
                $row = mysqli_fetch_row($result);
                $id = $row[0];
                $foretag = Users::check_given_foretag($id);
                $row = mysqli_fetch_row($foretag);
            }
            ?>

            <div class="container givet-foretag">
                <h4>Du har fått en plats hos:</h4>
                <h1><div class="given-foretag-text"><?php echo $row[0]; ?></div></h1>
                <h4>Välkommen!</h4>
            </div>
        </div>

        <div class="modal fade" id="AlertModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" id="alert-text">
                        Val uppdaterat!
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div> 
            </div>    
        </div>

    </body>
    <script src="assets/js/index.js"></script>
</html>