<?php
include("include/models/header.php");
include("include/html/default.php");
?>
    <body>

        <div class="container">
        <?php  
        include "include/models/succesRatio.php";
        ?>
            wassup
        </div>

        <div class="testData_button">
                <button type="button" class="btn btn-primary" onclick="generateTestData()">Generera testdata</button>
            </div>

    </body>
</html>