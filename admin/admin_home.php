<?php
	session_start();
	
	include("db_config/db.php");
	
	$admin_id = $_SESSION['admin_id'];
	$admin_name = $_SESSION['admin_name'];
	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Section | Home</title>
</head>

<body>
	<h1 align="center">Olamide Hospital</h1>
    <h4 align="center">Admin Section</h4>
    <hr />
    <h2>Welcome Admin.</h2>
    <?php
    echo "<p> Admin ID: <strong>".$admin_id."</strong></p>";
	echo "<p>Admin Username: <strong>".$admin_name."</strong></p>";
	?>
    <hr />
    
    <a href="admin_home.php">Home</a>
    <a href="add_staff.php">Add Staff</a>
    <a href="view_staff.php">View Staff</a>
    <p align="right"><a href="logout.php">Logout</a></p>
    <hr />
</body>
</html>