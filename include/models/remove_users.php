<?php

include("header.php");

$connection = connect();
$query = "DELETE FROM user_picks";
$result = $connection->query($query);
$query = "DELETE FROM assigned_to_user";
$result = $connection->query($query);
$connection = disconnect();

header("location: ../../admin.php");
?>


