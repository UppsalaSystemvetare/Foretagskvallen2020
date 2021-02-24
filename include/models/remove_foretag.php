<?php

include("header.php");

  $connection = connect();
  $fid = $_GET["foretag_id"];
  $query = "DELETE FROM foretag WHERE (foretag_id = '".$fid."')";
  $connection->query($query);
  $fid = $connection->real_escape_string($_GET["foretag_id"]);

  echo $query;
  header("location: ../../admin.php");

?>
