<?php
	if (!isset($_SESSION)) { // check if the session is not started then start the session
  		session_start();
  	}

	if(!isset($_SESSION['role'])||$_SESSION['role']!='admin'){ // check if the session role is not admin
		header('location:login.php');
		die();
	}
?>