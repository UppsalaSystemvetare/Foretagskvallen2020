<?php
include("include/html/default.php");
?>
    <body>
        <div class="foretag-wrapper">

            <div class="container-md">
                <h1>Välkommen till företagskvällen!</h1>
                <div class="intro-text">
                    <p>Under företagens presentationer kommer du aktivt kunna välja vilket företag du helst vill besöka senare. 
                        Scrolla ner och flytta runt de 5 företagen, med de du helst vill besöka längst upp! Du kan ändra dig när som 
                        helst, vi kommer meddela när valen är låsta. </p>
                </div>
            </div>

            <h2>Välj här</h2>
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