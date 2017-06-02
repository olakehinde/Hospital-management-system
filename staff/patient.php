<?php
	include("../includes/staff_header.php");
	
	$mon = array(1=> 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
?>


<!-- 
I intentionally commented out this section. 
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
<title>Patient Registration</title>
</head>


<body>
 
    <?php
    echo "<p> Staff ID: <strong>".$staff_id."</strong></p>";
	echo "<p>Staff Username: <strong>".$staff_username."</strong></p>";
	echo "<p>Staff Name: <strong>".$staff_name."</strong>";
	?>
    <hr />
    <h4 align="center">Patient Registration Portal</h4>
    
    <a href="../index.html"><img src="../image/images_22.jpeg" height="50" width="50" /></a>
    <hr />
    
    <a href="staff_home.php">Home</a>
    <a href="patient.php">Patient</a>
    <a href="diagnose.php">Diagnosis</a>
    <a href="treatment.php">Treatment</a>
    <a href="payment.php">Payment</a>
    <a href="logout.php">Logout</a>
    <hr />
   comment ends here
    -->
    
    <?php
		//form validation starts here.
		if (array_key_exists('register', $_POST)) {
			$error = array();
			
			//form field validation starts here
			if (!empty($_POST['fname'])) {
				$fname = mysqli_real_escape_string($db, $_POST['fname']);
				}
				else {
					$error[] = "Enter your Firstname";
				}
	
			if (!empty($_POST['lname'])) {
				$lname = mysqli_real_escape_string($db, $_POST['lname']);
				}
				else {
					$error[] = "Enter your Lastname";
				}
	
			if (!empty($_POST['gender'])) {
				$gender = mysqli_real_escape_string($db, $_POST['gender']);
				}
				else {
					$error[] = "Select your gender";
				}
	
			if (!empty($_POST['day'])) {
				$day = mysqli_real_escape_string($db, $_POST['day']);
				}
				else {
					$error[] = "Select day";
				}
	
			if (!empty($_POST['month'])) {
				$month = mysqli_real_escape_string($db, $_POST['month']);
				}
				else {
					$error[] = "Select month";
				}
				
			if (!empty($_POST['year'])) {
				$year = mysqli_real_escape_string($db, $_POST['year']);
				}
				else {
					$error[] = "Select year";
				}
		
			if (!empty($_POST['address'])) {
				$address = mysqli_real_escape_string($db, $_POST['address']);
				}
				else {
					$error[] = "Enter your address";
				}
		
			if (!empty($_POST['phone'])) {
				$phone = mysqli_real_escape_string($db, $_POST['phone']);
				}
				else {
					$error[] = "Enter phone number";
				}
			
			//validating the error array
			if (empty($error)) {
				$date = $day.'-'.$month.'-'.$year;
				
				//query database and insert the patients info into DB
				$db_insert = mysqli_query($db, "INSERT INTO patient VALUES (NULL, 
																			'".$fname."',
																			'".$lname."',
																			'".$gender."',
																			'".$date."',
																			'".$address."',
																			'".$phone."')")
																			or die(mysqli_error($db));	
			//create a header
			$sucess = "Patient sucessfully registered";
			header("Location:patient.php?sucess=$sucess");
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
    		<legend><strong>Enter Patients details below</strong></legend>
    		<p>Patient Name: <input type="text" name="fname" placeholder="Firstnanme" />
            				 <input type="text" name="lname" placeholder="Lastname" /></p>
    		<p>Gender: Male <input type="radio" name="gender" value="M" />
            		   Female <input type="radio" name="gender" value="F" /></p>
    		<p>Date of Birth: 
            		<select name="day">
                    <option value="">Select day</option>
                    <?php
						for ($dy = 1; $dy<=31; $dy++) {
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
						foreach ($mon as $v => $k) {
							if ($v < 10) {
					?>
                    <option value="<?php echo 0 .$v ?>"><?php echo $k ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $v ?>"><?php echo $k ?></option>
                    <?php  } } ?>
                    </select>
                    
                    <select name="year">
                    <option value="">Select year</option>
                    <?php 
						for ($yr = 1960; $yr <= date('Y'); $yr++) {
					?>
                    <option value="<?php echo $yr ?>"><?php echo $yr ?></option>
                    <?php } ?>
                    </select></p>
    
    				<p>Address: <br /> <textarea name="address" rows="8" cols="30" placeholder="Enter your Address"></textarea></p>
                    <p>Phone: <input type="tel" name="phone" placeholder="Phone Number" maxlength="11" /></p>
                    
                    <input type="submit" name="register" value="Register Patient" />
    	</fieldset>
    </form>
</body>
</html>