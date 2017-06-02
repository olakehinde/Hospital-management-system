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
<title>Staff Registration Portal</title>
</head>

<body bgcolor="#006699">
	<h3>Staff Registration Portal</h3>
    
     <?php
    echo "<p> Admin ID: <strong>".$admin_id."</strong></p>";
	echo "<p>Admin Username: <strong>".$admin_name."</strong></p>";
	?>
    <hr />
    
    <a href="admin_home.php">Home</a>
    <a href="add_staff.php">Add Staff</a>
    <a href="view_staff.php">View Staff</a>
    <a href="logout.php">Logout</a>
    <hr />
    
    <?php 
		$db_query = mysqli_query($db, "SELECT * FROM staff") or die(mysqli_error());
    ?>
    
    <table align="center" border="2" cellpadding="2" cellspacing="5" bgcolor="#CC0033">
    <tr bgcolor="white">
    	<th>Name</th><th>Gender</th><th>Date of Birth</th><th>Address</th><th>Phone Number</th><th>Staff designation</th>
    </tr>
    <?php
		while ($db_result = mysqli_fetch_array($db_query)) {
	?>
    
    <tr bgcolor="#999999">
    	<td><?php echo $db_result[1].' - '.$db_result[2] ?></td>
        <td><?php echo $db_result[3] ?></td>
        <td><?php echo $db_result[4] ?></td>
        <td><?php echo $db_result[5] ?></td>
        <td><?php echo $db_result[6] ?></td>
        <td><?php echo $db_result[7] ?></td>
    </tr>
    <?php } ?>
    
</body>
</html>