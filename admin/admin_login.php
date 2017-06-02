<?php
	session_start();
	include("db_config/db.php");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>
</head>

<body>
    	<h3>Admin Login</h3>
        
        <?php
        //form validation begins here
		if (array_key_exists('login', $_POST)) {
			$error = array();
			
			if (!empty($_POST['uname'])) {
				$uname = mysqli_real_escape_string($db, $_POST['uname']);
				}
				else {
					$error[] = "Enter Username";
				}
			
			if (!empty($_POST['pword'])) {
				$pword = md5(mysqli_real_escape_string($db, $_POST['pword']));
				}
				else {
					$error[] = "Enter Password";
				}
				
			if (empty($error)) {
				//query the db
				$query = mysqli_query($db, ("SELECT * FROM admin WHERE username = '".$uname."' AND 
											harshed_password = '".$pword."'")) or die(mysqli_error($db));
				if (mysqli_num_rows($query) == 1) {
					$db_result = mysqli_fetch_array($query);

				//establish a session
				$_SESSION['admin_id'] = $db_result['admin_id'];
				$_SESSION['admin_name'] = $db_result['username'];
		
				//admin logged in and redirected to the admin home page		
				header("Location:admin_home.php");
				}
				else {
					$error_msg = "Username or Password Incorrect";
					header("Location:admin_login.php?error=$error_msg");
				}
			}
				else {
					foreach ($error as $err) {
						echo "<p>*".$err."</p>";
					}
				}
		}
		
		if (isset($_GET['error'])) {
			echo "<p>".$_GET['error']."</p>";
		}
		
        ?>
      <form action="" method="post">
        <p><input name="uname" type="text" placeholder="Username" /></p>
        <p><input type="password" name="pword" placeholder="Password" /></p>
        <input type="submit" name="login" value="Login" />
      </form>


</body>
</html>