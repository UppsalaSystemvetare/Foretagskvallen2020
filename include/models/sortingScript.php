<?php
include "hungarian.php";
use RPFK\Hungarian\Hungarian;

$connection = connect();
$query = "SELECT user_id, user_picks FROM user_picks LIMIT 10";
$result = $connection->query($query);


$query = "SELECT COUNT(foretag_id) FROM foretag";
$result = $connection->query($query);

while($row = mysqli_fetch_array($result)) { 
    $numberOfCompanies = $row[0];
}

// Ska fixa tomma platser i matrixen ifall det finns färre folk än platser. 
$numberOfPeople = 100;

// Ändra så att denna kommer från admin sidan
$numberOfPeoplePerCompany = 2; 

$matrix = array();
$userID = array();
$companyId = array();
$counter = 0;

while($row = mysqli_fetch_array($result)) {
    $userID [] = $row["user_id"];
    $picks = $row["user_picks"];
    $rad = array();

    for ($i = 0; $i < $numberOfCompanies; $i++) {    

        for ($j = 0; $j < $numberOfPeoplePerCompany; $j++) {
            $rad[] = substr($picks, $i, 1); 

            $companyId [$counter] = ($i + 1);
            $counter++;
        }
    }
    $matrix [] = $rad;
}

$hungarian = new Hungarian($matrix);

$allocation = $hungarian->solve();

$query = "DELETE FROM assigned_to_user";
$result = $connection->query($query);

for ($y = 0; $y < count($allocation); $y++) {

    $temp = $companyId[$allocation[$y]];
    $query = "INSERT INTO assigned_to_user (user_id, foretag_id) VALUES ('$userID[$y]', '$temp')";
    $result = $connection->query($query);
} 

$connection = disconnect();