<?php
session_start();

?>

<?php
	include 'dbcon.php';
	if(isset($_POST['submit']))
	{
		$Email = $_POST['email'];
		$pwd = $_POST['password'];
		
		$emailquery = "select * from signup where Email='$Email' and status='active' ";
		$query = mysqli_query($con,$emailquery);
		
		$emailcount = mysqli_num_rows($query);
		
		if($emailcount)
		{
			$emailpass = mysqli_fetch_array($query);
			$dbpass = $emailpass['password'];

			$_SESSION['fetchemail'] = $emailpass['email'];
		
			
			$passdecode = password_verify($pwd, $dbpass);
			
			if($passdecode)
			{
				?>
				<script>
					alert("Login Successful");
				</script>
				<?php
				?>
				<script>
					location.replace("loginpage.php");
				</script>
				<?php
			}
			else
			{
				?>
				<script>
					alert("Incorrect Password?");
				</script>
				<?php
			}
		}
		else
		{
			?>
			<script>
				alert("Invalid email");
			</script>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include 'Style/css1.css';
	?>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>	
<body><br><br>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" Method="POST" style="max-width:400px;margin:auto" class="container">
		<h1 align="center">Login</h1>	
		<div>
		<p style="background-color:cyan;"> 
			<?php
				if(isset($_SESSION['msg']))
				{
					echo $_SESSION['msg'];
				}
				else
				{
					echo $_SESSION['msg'] =" ";
				}
				 
			?>
		</p>
		</div>
		<div class="input-container">
			<i class="fa fa-envelope icon"></i>
			<input class="input-field" type="text" placeholder="Enter email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format" autofocus required>
		</div>
  
		<div class="input-container">
			<i class="fa fa-lock icon"></i>
			<input class="input-field" type="password" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		</div>
		<div align="right">
		<a href="Forgot.php">Forgot Password</a>
		</div><br>
		<button type="submit" class="btn" name="submit">Login</button>
		<p>Don't have an account?&nbsp;&nbsp;<a href="Signup.php">Sign up.</a></p>

		
	</form>
	</div>
</body>
</html>
