<?php
	session_start();
	
	include("db_config/db.php");
	
	$staff_id = $_SESSION['staff_id'];
	$staff_username = $_SESSION['username'];
	$staff_name = $_SESSION['staff_name'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
</head>


<body>
 
    <?php
    echo "<p> Staff ID: <strong>".$staff_id."</strong></p>";
	echo "<p>Staff Username: <strong>".$staff_username."</strong></p>";
	echo "<p>Staff Name: <strong>".$staff_name."</strong>";
	?>
    <hr />
    <h4 align="center">Payment Information</h4>
    
    <a href="../index.html"><img src="../image/images_22.jpeg" height="50" width="50" /></a>
    <hr />
    
    <a href="staff_home.php">Home</a>
    <a href="patient.php">Patient</a>
    <a href="diagnose.php">Diagnosis</a>
    <a href="treatment.php">Treatment</a>
    <a href="payment.php">Payment</a>
    <a href="logout.php">Logout</a>
    <hr />