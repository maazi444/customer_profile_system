<?php
	include("includes/connection.php");
	include("includes/insertPicture.php");
	$userrCpasswordError = "";
	$userrName="";
	$userrEmail="";
	$userrEmailError="";
	$userrPassword="";
	$userrCcpassword="";
	$userrPasswordError = "";
	$msg="";
	if(isset($_POST['register']))
	{
		$userrName = mysqli_real_escape_string($connection, $_POST['userrName']);
		$userrEmail = mysqli_real_escape_string($connection, $_POST['userrEmail']);
		$userrPassword = mysqli_real_escape_string($connection, $_POST['userrPassword']);
		$userrCcpassword = mysqli_real_escape_string($connection, $_POST['userrCpassword']);	
		if($_POST['userrPassword'] != $_POST['userrCpassword'])
		{
			$userrCpasswordError = "Passwords didn't match";
		}

		else if(strlen($userrPassword) < 3)
		{
			$userrPasswordError = "Password must be at least 3 characters";
		}

		else
		{
			$userrName = $_POST['userrName'];
			$userrEmail = $_POST['userrEmail'];
			$userrPassword = $_POST['userrPassword'];
			$recordset = mysqli_query($connection, "select * from users where user_email='$userrEmail'");
			if(mysqli_num_rows($recordset)>0)
			{
				$userrEmailError="E-mail is already in use. Please use another E-mail";
			}
			else
			{
				$sql="insert into users(user_email,user_name,user_password,user_picture,block_user) values('$userrEmail','$userrName','$userrPassword','$newfilename','0')";
				mysqli_query($connection, $sql);
				$msg = "inserted";
				header("location:profilePage.php?email=$userrEmail&name=$userrName");
			}
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<title>CPS - Sign Up</title>
</head>
<body>
	<div class="container">
		<div class="contentBox">
			<div class="registerForm">
				<h1>Sign Up</h1>
				<form autocomplete="off" method="POST" enctype="multipart/form-data">
					<input type="text" name="userrName" placeholder="Name" required>
					<!-- <span class="errorClass"></span> -->

					<input type="email" name="userrEmail" placeholder="Email" required>
					<span class="errorClass"><?php echo $userrEmailError; ?></span>
					
					<input type="password" name="userrPassword" placeholder="Password" required>
					<span class="errorClass"><?php echo $userrPasswordError ?></span>

					<input type="password" name="userrCpassword" placeholder="Confirm Password" required>
					<span class="errorClass"><?php echo $userrCpasswordError; ?></span>

					<input type="file" name="image">
					<div class="rmDiv">
						<input id="rmInput" type="checkbox" name="rememberme"><label for="rmInput">Remember me</label>
					</div>
					<input type="submit" name="register" value="Sign Up">
				</form>
				<p>Already have an account? <a href="loginUser.php" class="loginBtn">Sign In</a></p>
			</div>
			
		</div>
	</div>
	<script src="js/msgHide.js"></script>
</body>
</html>