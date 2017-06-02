<?php 
	session_start();
	
	unset($_SESSION['admin_id']);
	unset($_SESSION['admin_name']);

	header("Location:admin_login.php");
	
	session_destroy();
?>