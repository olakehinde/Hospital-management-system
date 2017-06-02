<?php
	include("../includes/payment_header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
</head>

<body>
	<strong>Enter Payment details below</strong>
    <?php	
    	//form validation starts here
		if (isset($_POST['pay'])) {
    		$error = array();
			
			//validating the form fields
			if (!empty($_POST['amount'])) {
				$amount = mysqli_real_escape_string($db, $_POST['amount']);
				}
				else {
					$error[] = "Enter amount paid";
				}
    	
			if (!empty($_POST['payee'])) {
				$payee = mysqli_real_escape_string($db, $_POST['payee']);
				}
				else { 
					$error[] = "Enter Patients name";
				}
    
			if (!empty($_POST['pay_desc'])) {
				$pay_desc = mysqli_real_escape_string($db, $_POST['pay_desc']);
				}
				else {
					$error[] = "Enter Payment description";
				}
    
    		if (empty($error)) {
    			$db_patient = mysqli_query($db, "SELECT * FROM patient WHERE (firstname AND lastname) = '".$payee."'")
											or die(mysqli_error);
				if (mysqli_num_rows($db_patient) == 1) {
					$db_patient_result = mysqli_fetch_array($db_patient);
					$patient_id = $db_patient_result['patient_id'];
					}
					else {
						$error_msg = "Enter the correct Patients name. (Firstname + Lastname)";
						header("Location:payment.php?error=$error_msg");
					}
				$db_insert = mysqli_query($db, "INSERT INTO payment VALUES (NULL,
																			'".$staff_id."',
																			'".$patient_id."',
																			'".$payee."',
																			'".$amount."',
																			'".$pay_desc."',
																			NOW())")
																			or die(mysqli_error($db));
			//establish a header and redirect
			$sucess = "Patient payment details added sucessfully";
			header("Location:payment.php?sucess=$sucess");
			}
			else {
				foreach ($error as $err) {
					echo "<p>*".$err."</p>";
				}
			}
		}
		
		if (isset($_GET['error_msg'])) {
			echo $_GET['error_msg'];
		}
		
		if (isset($_GET['sucess'])) {
			echo "<em>".$_GET['sucess']."</em>";
		}
    ?>
    <form action="" method="post">
		<p>The Sum of: <input type="text" name="amount" placeholder="Amount Paid" /></p>
        <p>Paid by: <input type="text" name="payee" placeholder="Enter Patients name" /></p>
        <p>Being Payment for: <input type="text" name="pay_desc" placeholder="Payment for" /></p>
        
        <input type="submit" name="pay" value="Make Payment" />
	</form>
</body>
</html>