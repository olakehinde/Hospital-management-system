<?php
	include("../includes/treatment_header.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<h3>Patients Treatment detail</h3>
    <?php
		//form validation begins here
		if (isset($_POST['submit'])) {
			$error = array();
			
			//validation of form field begins here
			if (!empty($_POST['fname'])) {
				$fname = mysqli_real_escape_string($db, $_POST['fname']);
				}
				else {
					$error[] = "Enter Patients Firstname";
				}
		
			if (!empty($_POST['lname'])) {
				$lname = mysqli_real_escape_string($db, $_POST['lname']);
				}
				else {
					$error[] = "Enter Lastname";
				}
			
			if (!empty($_POST['treat'])) {
				$treat = mysqli_real_escape_string($db, $_POST['treat']);
				}
				else {
					$error[] = "Fill in the treatment";
				}
		
			//validating the error array
			if (empty($error)) {
				$db_select = mysqli_query($db, "SELECT patient_id FROM patient WHERE firstname = '".$fname."'
																				AND lastname = '".$lname."'")
																				or die(mysqli_error($db));
				$db_result = mysqli_fetch_array($db_select);
				$patient_id = $db_result['patient_id'];
				
				//insert into the treatment table
				$db_treat = mysqli_query($db, "INSERT INTO treatment VALUES (NULL,
																			 '".$patient_id."',
																			 '".$treat."')")
																			 or die(mysqli_error($db));
				//establish the header and redirect
				$sucess = "Treatment details sucessfully entered into DB";
				header("Location:treatment.php?sucess=$sucess");
			}
			else {
				foreach ($error as $key) {
					echo "<p>*".$key."</p>";	
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
        <p>Treatment details: <br /><textarea name="treat" rows="10" cols="30"></textarea></p>
        
        <input type="submit" name="submit" value="Submit" />
    </form>
</body>
</html>