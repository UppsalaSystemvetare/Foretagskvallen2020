<?php

    include("header.php");
    $firstorsecond = [];
    $foretag = [];

    $connection = connect();

    $query = "SELECT foretag_id, foretag_name FROM foretag ORDER BY foretag_id";
    $result = $connection->query($query);

    while($foretag_data = mysqli_fetch_array($result)){
        $foretag_name = $foretag_data["foretag_name"];
        $foretag [] = $foretag_name; //Lägger till företagsnamnet
        $firstorsecond [] = 0; //Lägger till en räknare för varje företag
    }


    $query = "SELECT user_picks FROM user_picks";
    $result = $connection->query($query);

    while($picks = mysqli_fetch_array($result)){
        $user_picks = $picks["user_picks"];

        for($i=0; $i < 2; $i++) { 
            $val = substr($user_picks, $i, 1);
            $firstorsecond[$val-1]++;
        }
    }

    $connection = disconnect();
?>


<table>
    <tr>
        <th>Företag</th>
        <th>Antal som ville ha som första- eller andrahandsval</th>
    </tr>
    <?php
        for($i=0; $i < count($foretag); $i++) : ?>
            <tr>
                <td><?php echo $foretag[$i]; ?> </td>
                <td><?php echo $firstorsecond[$i] ?> </td>
            </tr>
        <?php endfor; ?>
</table>