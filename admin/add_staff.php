<?php
	session_start();
	
	include("db_config/db.php");
	
	$admin_id = $_SESSION['admin_id'];
	$admin_name = $_SESSION['admin_name'];
	
	$month = array(1=> 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
	$staff_type = array(1=> 'Doctor', 'Nurse', 'Pharmacist', 'Receptionist');

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
    	if (array_key_exists('reg', $_POST)) {	
    		$error = array();
			
			if (!empty($_POST['fname'])) {
				$fname = mysqli_real_escape_string($db, $_POST['fname']);	
				}
				else {
				$error[] = "Enter Firstname";
				}
			
			if (!empty($_POST['lname'])) {
				$lname = mysqli_real_escape_string($db, $_POST['lname']);
				}
				else {
					$error[] = "Enter Lastname";
				}
			
			if (!empty($_POST['gender'])) {
				$gender = mysqli_real_escape_string($db, $_POST['gender']);
				}
				else {
					$error[] = "Select gender";
				} 
				
			if (!empty($_POST['day'])) {
				$day = mysqli_real_escape_string($db, $_POST['day']);
				}
				else {
					$error[] = "Select a day";	
				}
			
			if (!empty($_POST['month'])) {
				$mon = mysqli_real_escape_string($db, $_POST['month']);
				}
				else {
					$error[] = "Select a month";
				}
			
			if (!empty($_POST['year'])) {
				$year = mysqli_real_escape_string($db, $_POST['year']);
				}
				else {
					$error[] = "Select a year";
				}
			
			
			
			if (!empty($_POST['address'])) {
				$add = mysqli_real_escape_string($db, $_POST['address']);
				}
				else {
					$error[] = "Enter your address";
				}
			
			if (!empty($_POST['phone'])){
				$phone = mysqli_real_escape_string($db, $_POST['phone']);
				}
				else {
					$error[] = "Enter phone number";
				}
			
			if (!empty($_POST['staff_desc'])) {
				$staff = mysqli_real_escape_string($db, $_POST['staff_desc']);
				}
				else {
					$error[] = "Choose staff Description";
				}
			
			if (!empty($_POST['pword'])) {
				$pword = mysqli_real_escape_string($db, $_POST['pword']);
				}
				else {
					$error[] = "Enter your password";
				}
			
			if (!empty($_POST['uname'])) {
				$uname = mysqli_real_escape_string($db, $_POST['uname']);
				}
				else {
					$error[] = "Enter a Username";
				}
			
			if (empty($error)) {
				$date = $day."-".$mon."-".$year;	
				$db_query = mysqli_query($db, "INSERT INTO staff VALUES (NULL,
																		 '".$fname."',
																		 '".$lname."',
																		 '".$gender."',
																		 '".$date."',
																		 '".$add."',
																		 '".$phone."',
																		 '".$staff."',
																		 '".$uname."',
																		 '".$pword."')")
																		 or die(mysqli_error());
				$sucess = "Staff Sucessfully registered in the DB";
				header("Location:add_staff.php?sucess=$sucess");
			}
			else {
				foreach ($error as $err) {
					echo "<p>*".$err."</p>";
				}
			
			}
		}
		
		if (isset($_GET['sucess'])) {
			echo $_GET['sucess'];
		}
	?>
	<form action="" method="post">
		<fieldset>
		<legend><strong>Enter Staff details here</strong></legend>
			<p>Staff Name: <input type="text" name="fname" placeholder="Enter Firstname" />
            			<input type="text" name="lname" placeholder="Enter Lastname" /></p>
			<p>Date of Birth: <select name="day">
            				  <option value="">Select day</option>
                              <?php 
							  for ($dy=1; $dy<=31; $dy++) {
								  if ($dy < 10) {
							  ?>
                              <option value="<?php echo 0 .$dy ?>"><?php echo $dy ?></option>
                              <?php } else { ?>
								<option value="<?php echo $dy ?>"><?php echo $dy ?></option>
                                <?php } } ?>
                                </select>
                                
                              <select name="month">
                              <option value="">Select month</option>
                              <?php
							  	foreach ($month as $k => $v) {
									if ($k < 10) {
							  ?>
                              <option value="<?php echo 0 .$k ?>"><?php echo $v ?></option>
                              <?php } else { ?>
                              <option value="<?php echo $k ?>"><?php echo $v ?></option>
                              <?php } } ?>
                              </select>
                              
                              <select name="year">
                              <option value="">Select year</option>
                              <?php 
								for ($yr=1960; $yr<=date('Y'); $yr++) {
                              ?>
                              <option value="<?php echo $yr ?>"><?php echo $yr ?></option>
                              <?php } ?>
                              </select>
                              </p>
                              
                              <p>Gender: Male <input type="radio" name="gender" value="M" />
                              			 Female <input type="radio" name="gender" value="F" /></p>
                              <p>Address:<br /> <textarea name="address" rows="5" cols="20" placeholder="Enter your Address"></textarea></p>
                              <p>Telephone: <input type="tel" name="phone" placeholder="Telephone" maxlength="11" /></p>
                              <p>Staff Description: <select name="staff_desc">
                              		<option value="">Choose Staff Description</option>
                                    <?php 
										foreach($staff_type as $val) {
									?>
                                    <option value="<?php echo $val ?>"><?php echo $val ?></option>
                                    <?php } ?>
                                    </select></p>
                              <p>Username: <input type="text" name="uname" placeholder="Username" /></p>
                              <p>Password: <input type="password" name="pword" placeholder="Password" /></p>
                              
                              <input type="submit" name="reg" value="Register Staff" />
                                
		</fieldset>
	</form>
</body>
</html>