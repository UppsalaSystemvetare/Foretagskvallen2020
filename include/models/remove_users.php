<?php

include("header.php");

$connection = connect();
$query = "DELETE FROM user_picks";
$result = $connection->query($query);
$connection = disconnect();

?>