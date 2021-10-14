<?php
	session_start();
	include 'dbcon.php';
	
	if(isset($_GET['token']))
	{
		$token = $_GET['token'];
		$updatequery = "update signup set status='active' where token='$token'";
		$query = mysqli_query($con, $updatequery);
		
		if($query)
		{
			if(isset($_SESSION['msg']))
			{
				$_SESSION['msg'] = "Email verified successfully";
				header('location:Index.php');
			}else
			{
				$_SESSION['msg'] = "";
				header('location:Index.php');
			}
		}
		else
		{
			$_SESSION['msg'] = "Accout not updated.";
			header('location:Signup.php');
		}
	}
?>