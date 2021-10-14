<?php
session_start();

?>

<?php
	include 'dbcon.php';
	if(isset($_POST['submit']))
	{
		$email = $_POST['email'];
		
		$emailquery = "select * from signup where Email='$email' ";
		$query = mysqli_query($con,$emailquery);
		
		$emailcount = mysqli_num_rows($query);
		
		if($emailcount)
		{
			$userdata = mysqli_fetch_array($query);
			$name = $userdata['name'];
			$token = $userdata['token'];
			
			$subject = "Forgot Password";
			$body = "Hi, $name, Click here too change your password
			http://localhost/Signup/Changepwd.php?token=$token ";
				
			$Sender = "From: abcdef@gmail.com";

			if(mail($email, $subject, $body, $Sender)) 
			{
				$_SESSION['msg'] = "Check your mail reset your password";
					
				header('location:Index.php');
			}
			else 
			{
				echo "Email sending failed...";
			}
			
			
		}
		else
		{
			?>
			<script>
				alert("Email Not Found?");
			</script>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<?php
		include 'css1.css';
	?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="bg">
		<br>
		<br>
	<form action="#" Method="POST" style="max-width:400px;margin:auto" class="container">
		<h1 align="center">Recover your Account</h1>
		<p align="center">Please fill valid email</p>
		<div class="input-container">
			<i class="fa fa-envelope icon"></i>
			<input class="input-field" type="text" placeholder="Enter email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format" autofocus required>
		</div><br>
		
		<button type="submit" class="btn" name="submit">Send Mail</button>
		<p>Already have an account?&nbsp;&nbsp;<a href="Index.php">Login</a></p>
		
	</form>
	<br><br><br><br><br><br>
	</div>
</body>
</html>
