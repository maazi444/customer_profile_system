<?php
	include("includes/connection.php");
	$profileEmail="";
	$profileName="";
	if(isset($_GET['email']))
	{
		$profileEmail = $_GET['email'];
	}

	if(isset($_GET['name']))
	{
		$profileName = $_GET['name'];
	}

	$sql = "select * from users where user_email = '$profileEmail'";
	$records = mysqli_query($connection, $sql);
	$record = mysqli_fetch_array($records);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Profile System</title>
</head>
<body>
	<div class="container">
		<div class="profileBox">
			<div class="header">
				<h1 class="pageInfo">Customer Profile System</h1>
				<ul>
					<li><a href="#">Update Profile</a></li>
					<li><a href="logoutUser.php">Log Out</a></li>
				</ul>
			</div>
			<div class="profileContent">
				<div class="picSection">
					<img src="user_pictures/<?php echo $record['user_picture']; ?>"/>
				</div>
				<h1 class="userNameHeading"><?php echo $profileName; ?></h1>
				<span class="spanHeading">User Email: </span><span class="spanContent"><?php echo $profileEmail; ?></span>
				<br/><br/>
				<span class="spanHeading">User Name: </span><span class="spanContent"><?php echo $profileName; ?></span>
				<div class="profileActions">
					<a class="profileDelete" href="userDeleteAccount.php?name=<?php echo $profileName; ?>">Delete My Account</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>