<?php
	session_start();
	include("db_config/db.php");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Staff Login</title>
</head>

<body>
	<H3>Staff Login</H3>
	<?php
    //form validation
    if (array_key_exists('login', $_POST)) {
		$error = array();
		
		if (!empty($_POST['uname'])) {
			$uname = mysqli_real_escape_string($db, $_POST['uname']);
			}
			else {
				$error[] = "Enter Username";
			}
		
		if (!empty($_POST['pword'])) {
			$pword = mysqli_real_escape_string($db, $_POST['pword']);
			}
			else {
				$error[] = "Enter Password";
			}
		
		//validating the error array
		if (empty($error)) {
			$db_query = mysqli_query($db, ("SELECT * FROM staff WHERE staff_username = '".$uname."' 
													 AND password = '".$pword."'")) 
													 or die(mysqli_error());	
			if (mysqli_num_rows($db_query) == 1) {
				$result = mysqli_fetch_array($db_query);
				
				//establish a session
				$_SESSION['staff_id'] = $result['staff_id'];
				$_SESSION['username'] = $result['staff_username'];
				$_SESSION['staff_name'] = $result['firstname'].' '.$result['lastname'];	
				
				//login and redirect to the staff homepage area
				header("Location:staff_home.php");
			
			
			}
			else {
				$error_msg = "Username or Password Incorrect";
				header("Location:staff_login.php?error=$error_msg");
				}
			}
			else {
				foreach ($error as $key) {
					echo "<p>*".$key."</p>";
				}
		}
	}
	
	if (isset($_GET['error_msg'])) {
		echo "<p>".$_GET['error_msg']."</p>";
	}
    ?>
	<form action="" method="post">
            <p><input type="text" name="uname" placeholder="Username" /></p>
            <p><input type="password" name="pword" placeholder="Password" /></p>
            
            <input type="submit" name="login" value="Login" />
    	
    
    
    </form>
</body>
</html>