<?php
include("include/html/default.php");
?>
    <body>

                <!-- Modal -->
                <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-lg" role="document">
                        <div class="modal-content">

                        <div class="modal-body">
                            <div class="container-md">
                                <h1>Välkommen till företagskvällen!</h1>
                                <div class="intro-text">
                                    <p>Under företagens presentationer kommer du att kunna välja vilket företag du helst vill besöka senare.
                                    För att vi ska kunna placera dig i systemet behöver vi veta vad du heter.</p>
                                    <p> Var vänlig fyll i både för- och efternamn :</p>
                                    <br>
                                    <form>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="InputName" placeholder="För- och efternamn">
                                            <small id="emailHelp" class="form-text text-muted">Namnet används vid tilldelning av företagscase och kan 
                                            ej ändras i efterhand - så stava rätt!</small>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="contbutton">Gå vidare</button>
                            </div>
                        </div>
                    </div>
                </div>



        <div class="foretag-wrapper">
            <br>
            <div>
            Anmäld som:
            </div>
            <div class="h1 text-primary" id="nametag">
            </div>
            <br><br>
            <h2>Dags att välja företag!</h2>
            <div class="intro-text">
                    <p>
                    Flytta runt de 5 företagen och placera de du helst vill besöka högst upp! <br>
                    Du kan flytta runt dem hur många gånger som helst
                    under presentationerna och du kommer att förvarnas innan
                    valen blir låsta. 
                    </p>
                </div>
            <div class="foretag p-3 border bg-light">
                

                <p class="small-p">Dra och släpp företagen i önskad ordning.</p>

                <ul id="draggablePanelList" class="list-unstyled">
                    <li class="panel panel-info">
                        <div class="foretag p-3 border bg-light panel-heading">Företag 1</div>
                    </li>
                    <li class="panel panel-info">
                        <div class="foretag p-3 border bg-light panel-heading">Företag 2</div>
                    </li>
                    <li class="panel panel-info">
                        <div class="foretag p-3 border bg-light panel-heading">Företag 3</div>
                    </li>
                    <li class="panel panel-info">
                        <div class="foretag p-3 border bg-light panel-heading">Företag 4</div>
                    </li>
                    <li class="panel panel-info">
                        <div class="foretag p-3 border bg-light panel-heading">Företag 5</div>    
                    </li>
                </ul>

            </div>
        </div>

    </body>
    <script src="assets/js/index.js"></script>
</html>