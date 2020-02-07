<?php

include("header.php");

//Detta script räknar hur många som fick sitt förstahandsval, andrahandsval osv. 
$connection = connect();
$query = "SELECT user_id, user_picks FROM user_picks";
$result2 = $connection->query($query);

$query = "SELECT user_id, foretag_id FROM assigned_to_user";
$result = $connection->query($query);

$assigned = array();
while($row = mysqli_fetch_array($result)) { 
    $assigned [$row["user_id"]] = $row["foretag_id"];
}

$allPicks = array();
while($row = mysqli_fetch_array($result2)) { 
    $picks = $row["user_picks"];
    for ($i=1; $i <= strlen($picks); $i++) { 
        if($i == $assigned[$row["user_id"]]) {
            $allPicks[substr($picks, $i - 1, 1)] = $allPicks[substr($picks, $i - 1, 1)] + 1;
        }
    }
}

$query = "SELECT COUNT(foretag_id) FROM foretag";
$result = $connection->query($query);

while($row = mysqli_fetch_array($result)) { 
    $numberOfCompanies = $row[0];
}

for ($i=1; $i <= $numberOfCompanies; $i++) { 
    if(!$allPicks[$i] == 0) {
        $number = $allPicks[$i];
    }
    else {
        $number = 0;
    }

    echo "$number" . " personer fick deras " . $i . ":a-handsval ";
}

$connection = disconnect();

header("location: ../../admin.php");