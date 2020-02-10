<?php
include "header.php";
//lägger till x många användare i databasen med randomiserade val. 
$numberOfUsers = 100;

$connection = connect();
for ($i = 1; $i <= $numberOfUsers; $i++) { 

    $user_name = "Test User" . $i;
    $choices = str_shuffle("12345");
    $query = "INSERT INTO user_picks (user_name, user_picks) VALUES ('$user_name', '$choices')";
    $result = $connection->query($query);
}

$connection = disconnect();

header("location: ../../admin.php");