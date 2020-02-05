<?php
session_start();
include("include/html/default.php");
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
                            <p>För att vi ska kunna placera dig i systemet behöver vi veta vad du heter.</p>
                        </div>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="InputName" placeholder="För- och efternamn">
                                <small id="emailHelp" class="form-text text-muted">Ange ditt namn.</small>
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
            <div class="name-holder">
                <p>Anmäld som:</p>
                <h1 class="shadowed"><div class="h1 text-primary" id="nametag"><?php if(isset($_SESSION['name']) && !empty($_SESSION['name'])) { echo $_SESSION['name']; } ?></div></h1>
            </div>
            
            <h2>Dags att välja företag!</h2>
            <div class="intro-text">
                <p>
                Flytta runt de 5 företagen och placera de du helst vill besöka högst upp! 
                Du kan flytta runt dem hur många gånger som helst
                under presentationerna och du kommer att förvarnas innan
                valen blir låsta. 
                </p>
            </div>

            <div class="foretag p-3 border bg-light">

                <p class="small-p">Dra och släpp företagen i önskad ordning.</p>

                <ul id="draggablePanelList" class="list-unstyled">
                    <li class="panel panel-info">
                        <div class="foretag p-3 border bg-light panel-heading" id="1">Företag 1</div>
                    </li>
                    <li class="panel panel-info" id="2">
                        <div class="foretag p-3 border bg-light panel-heading" id="2">Företag 2</div>
                    </li>
                    <li class="panel panel-info" id="3">
                        <div class="foretag p-3 border bg-light panel-heading" id="3">Företag 3</div>
                    </li>
                    <li class="panel panel-info" id="4">
                        <div class="foretag p-3 border bg-light panel-heading" id="4">Företag 4</div>
                    </li>
                    <li class="panel panel-info" id="5">
                        <div class="foretag p-3 border bg-light panel-heading" id="5">Företag 5</div>    
                    </li>
                </ul>

            </div>
            <div class="submit_holder">
                <button type="button" class="btn btn-primary" onclick="updateUserChoice()">Uppdatera val</button>
            </div>

        </div>

        <div class="modal fade" id="AlertModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
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