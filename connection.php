<?php
	$host="localhost";
	$user="root";
	$password="";
	$db="web";
	$conn=mysqli_connect($host,$user,$password,$db);

	if(!$conn){
		die("cannot connect to db server");
	}

?>
