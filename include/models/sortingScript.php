<?php
include "header.php";
include "hungarian.php";
use RPFK\Hungarian\Hungarian;

$connection = connect();
$query = "SELECT user_id, user_picks FROM user_picks";
$result = $connection->query($query);

$query = "SELECT COUNT(foretag_id) FROM foretag";
$result2 = $connection->query($query);

while($row = mysqli_fetch_array($result2)) { 
    $numberOfCompanies = $row[0];
}

$numberOfPeoplePerCompany = $_POST["number_of_spots"];

$matrix = array();
$userID = array();
$companyId = array();
$counter = 0;

while($row = mysqli_fetch_array($result)) {
    $userID [] = $row["user_id"];
    $picks = $row["user_picks"];
    $rad_mult = array();

    for ($i = 0; $i < $numberOfCompanies; $i++) {    
        $CompPos = strpos($picks, strval($i+1));

        for ($j = 0; $j < $numberOfPeoplePerCompany; $j++) {
            $rad_mult[($i * $numberOfPeoplePerCompany) + $j] = $CompPos + 1;
            $companyId [$counter] = ($i + 1);
            $counter++;
        }
    }
    
    $matrix [] = $rad_mult;
}

$numberOfPeople = count($matrix);

while(count($matrix) < $numberOfCompanies * $numberOfPeoplePerCompany) {
    $rad = array();

    for ($i = 0; $i < $numberOfCompanies; $i++) {    

        for ($j = 0; $j < $numberOfPeoplePerCompany; $j++) {
            $rad[] = 100; 
        }
    }
    $matrix [] = $rad;
}

$hungarian = new Hungarian($matrix);

$allocation = $hungarian->solve();

$query = "DELETE FROM assigned_to_user";
$result = $connection->query($query);

for ($y = 0; $y < $numberOfPeople; $y++) {

    $temp = $companyId[$allocation[$y]];
    $query = "INSERT INTO assigned_to_user (user_id, foretag_id) VALUES ('$userID[$y]', '$temp')";
    $result = $connection->query($query);
} 

$connection = disconnect();

header("location: ../../admin.php");