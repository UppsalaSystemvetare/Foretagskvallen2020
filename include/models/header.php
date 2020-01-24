<?php

session_start();

if(!isset($_SESSION['user']) && !isset($_SESSION['rank'])){
    header("Location: login.php");
}

function connect(){
	
	$uname = "2020@u268441";
	$pass = "lUqc539BzlFa";
	$host = "mysql684.loopia.se";
	$dbname = "uppsalasystemvetare_se_db_3";

	$connection = new mysqli ( $host , $uname , $pass , $dbname );

	if ( $connection -> connect_error )
	{
		die ("Connection failed:". $connection . connect_error ) ;
	}
	
	return $connection;

}

function disconnect(){
	return null;
}
?>