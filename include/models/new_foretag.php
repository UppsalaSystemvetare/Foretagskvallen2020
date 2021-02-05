<?php

  $fname = $_GET["newForetag"];
  $flocation = $_GET["newLocation"];
  $query = "INSERT INTO foretag(foretag_name, foretag_location) VALUES ('".$fname."', '".$flocation."')";
  $connection->query($query);
  $fname = $connection->real_escape_string($_GET["newForetag"]);
  $flocation = $connection->real_escape_string($_GET["newLocation"]);

  echo $query;
  
?>
