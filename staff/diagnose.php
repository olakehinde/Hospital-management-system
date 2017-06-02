<?php
	include("../includes/patient_header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Diagnosis</title>
</head>

<body>
	<h3>Enter Patients Diagnosis Information.</h3>
    
    <?php
    	//form validation starts here
		if (array_key_exists('diagnose', $_POST)) {
			$error = array();
			
			//begin validating the form fields
			if (!empty($_POST['fname']))	 {
				$fname = mysqli_real_escape_string($db, $_POST['fname']);
				}
				else {
					$error[] = "Enter Patients firstname";
				}
	
			if (!empty($_POST['lname'])) {
				$lname = mysqli_real_escape_string($db, $_POST['lname']);
				}
				else {
					$error[] = "Enter Patients lastname";
				}
	
			if (!empty($_POST['dname'])) {
				$dname = mysqli_real_escape_string($db, $_POST['dname']);
				}
				else {
					$error[] = "Enter diagnosis";
				}
			
			if (!empty($_POST['test'])) {
				$test = mysqli_real_escape_string($db, $_POST['test']);
				}
				else {
					$error[] = "Enter Test carried out on Patient";
				}
	
			if (!empty($_POST['result'])) {
				$test_result = mysqli_real_escape_string($db, $_POST['result']);
				}
				else {
					$error[] = "Enter Test result";
				}
		
			//validate the error array
			if (empty($error)) {
				$db_patient = mysqli_query($db, "SELECT patient_id FROM patient WHERE firstname = '".$fname."'
																				AND	lastname = '".$lname."'")
																				or die(mysqli_error());
			$db_patient_result = mysqli_fetch_array($db_patient);
			
			//getting the patients id from the returned result
			$patient_id = $db_patient_result['patient_id'];
			
			//Now, we insert into the Diagnostics table in the database
			$db_diagnose = mysqli_query($db, "INSERT INTO diagnostics VALUES (NULL,
																					'".$patient_id."',
																					'".$dname."',
																					'".$test."',
																					'".$test_result."')")
																					or die(mysqli_error($db));
			//establish a header
			$sucess = "Submitted Sucessfully!";
			header("Location:diagnose.php?sucess=$sucess");
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
    	<p><input type="text" name="fname" placeholder="Patients Firstname" />
        <input type="text" name="lname" placeholder="Lastname" /></p>
    	<p><input type="text" name="dname" placeholder="Enter Diagnosis name" /></p>
        <p><input type="text" name="test" placeholder="Enter Test name" /></p>
        <p><input type="text" name="result" placeholder="Enter Test result" /></p>
        
        <input type="submit" name="diagnose" value="Submit" />
	
    </form>
</body>
</html>