<?php
    require "header.php";

    $user_name = $_POST["name"];
    $choices = $_POST["order"];

    $connection = connect();
    $query = "SELECT * FROM user_picks WHERE userName = '$user_name'";
    $result = $connection->query($query);
    $connection = disconnect();
    
    $connection = connect();

    if(mysqli_num_rows($result) == 0){
        $query = "INSERT INTO user_picks (userName, user_picks) VALUES ('$user_name', '$choices')";
    } else {
        $query = "UPDATE user_picks SET user_picks = $choices WHERE userName = '$user_name'";
    }
    
    $result = $connection->query($query);
    
    $connection = disconnect();
    
?>