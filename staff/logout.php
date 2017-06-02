<?php
	session_start();
	
	unset($_SESSION['staff_id']);
	unset($_SESSION['username']);
	unset($_SESSION['staff_name']);
	
	session_destroy();
	
	header("Location:staff_login.php");

?>