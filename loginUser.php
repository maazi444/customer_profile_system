<?php
	include("includes/connection.php");
	session_start();
	$msg="";
	$accountMsg="";
	$accountDeleted="";
	if(isset($_POST['login']))
	{
		$userlEmail = $_POST['userlEmail'];
		$userlPassword = $_POST['userlPassword'];
		if($userlEmail=="")
		{
			$msg="Email can not be empty.";
		}
		
		else if($userlPassword=="")
		{
			$msg="Password can not be empty.";
		}
		if($msg=="")
		{	
			$sql="select * from users where user_email='$userlEmail' and user_password='$userlPassword'";
			$records=mysqli_query($connection,$sql);
			$record=mysqli_fetch_array($records);
			if($record['user_block']==0)
			{
				if(isset($record['user_email']))
				{
					$_SESSION['auth']=1;
					header("location:profilePage.php?email=$userlEmail&name=".$record['user_name']);
				}
				else{
				
					header("location:loginUser.php?login=0");
				}
			}
			else{
					header("location:loginUser.php?block=1");
			}

		}

		
	}

	if(isset($_GET['deleted']))
	{
		$accountDeleted="Your Account have been deleted successfully";
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<title>CPS- Sign In</title>
</head>
<body>
	<div class="container">
		<div class="contentBox">
			<div class="loginForm">
				<h1>Sign In</h1>
				<span class="errorClass"><?php echo $accountDeleted; ?></span>
				<form class="loginFormStyle" autocomplete="off" method="POST">
					<input type="email" name="userlEmail" placeholder="Email" required>
					<input type="password" name="userlPassword" placeholder="Password" required>
					<?php 
						if(isset($_GET['login']))
						{
							$accountMsg="Invalid email or password";
						}
					?>
					<span class="errorClass"><?php echo $accountMsg; ?></span>
					<input type="submit" name="login" value="Sign In">
				</form>
				<p>Don't have an account? <a class="registerBtn" href="index.php">Sign Up</a></p>
			</div>
		</div>
	</div>
	<script src="js/msgHide.js"></script>
</body>
</html>