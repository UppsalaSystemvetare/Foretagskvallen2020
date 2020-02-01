<?php


$connection = connect();
$query = "SELECT * FROM user_picks WHERE user_name = '$user_name'";
$result = $connection->query($query);
$connection = disconnect();

$connection = connect();

if(mysqli_num_rows($result) == 0){
    $query = "INSERT INTO user_picks (user_name, user_picks) VALUES ('$user_name', '$choices')";
} else {
    $query = "UPDATE user_picks SET user_picks = $choices WHERE user_name = '$user_name'";
}

$result = $connection->query($query);

$connection = disconnect();