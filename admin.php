<?php
include("include/models/header.php");
include("include/html/default.php");
?>
    <body>
        <div class="container">
        <?php  
        include "include/models/succesRatio.php";
            include "include/models/check_assign.php";  
        // require "include/models/sortingScript.php";
        ?>
        
        </div>
        <div class="testData_button">
                <button type="button" class="btn btn-primary" onclick="generateTestData()">Generera testdata</button>
            </div>

    </body>
</html>
