<?php
	include("includes/connection.php");
	$deleteName = "";
	if(isset($_GET['name']))
	{
		$deleteName = $_GET['name'];
		echo $deleteName;
		mysqli_query($connection, "DELETE from users where user_name = '$deleteName'");
		header("location:loginUser.php?deleted");
	}
?>