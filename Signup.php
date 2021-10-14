<?php
session_start();
?>

<?php

include 'dbcon.php';
if(isset($_POST['submit']))
{
	$Name = mysqli_real_escape_string($con, $_POST['name']);
	$Email = mysqli_real_escape_string($con, $_POST['email']);
	$Mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$Password = mysqli_real_escape_string($con, $_POST['password']);
	$CPassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	
	$pwd = password_hash($Password, PASSWORD_BCRYPT);
	$cpwd = password_hash($CPassword, PASSWORD_BCRYPT);
	
	$token = bin2hex(random_bytes(20));
	
	
	
	$emailquery = "select * from signup where Email='$Email' ";
	$query = mysqli_query($con,$emailquery);
	
	$emailcount = mysqli_num_rows($query);

	if($emailcount>0)
	{
		?>
		<script>
			alert("Email Already Exits");
		</script>
		<?php
	}
	else
	{
		if($Password == $CPassword)
		{
			$insertquery = "insert into signup(name,email,mobile,password,confirm_password, token, status)
							values('$Name','$Email','$Mobile','$pwd','$cpwd','$token','Inactive')";
				
			$iquery1 = mysqli_query($con, $insertquery);
			if($iquery1)
			{
				
				$subject = "Email Verification";
				$body = "Hi, $Name, Click here too activate your account
				http://localhost/Signup/activate.php?token=$token ";
				
				$Sender = "From: abcdef@gmail.com"; 

				if (mail($Email, $subject, $body, $Sender)) 
				{
					$_SESSION['msg'] = "Check your mail to verify your email $Email";
					
					header('location:Index.php');
				}
				else 
				{
					echo "Email sending failed...";
				}
				?>
				<script>
					location.replace("Index.php");
				</script>
				<?php
			}
			else
			{
				?>
				<script>
					alert("Do not Registered");
				</script>
				<?php
			}
		}
		else
		{
			?>
			<script>
				alert("Password are not Matching");
			</script>
			<?php
		}
	}
	
}
?>



<!DOCTYPE html>
<html>
<head>
	<?php
		include 'css1.css';
	?>
	<title>Register Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body><br><br>

	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" Method="POST" style="max-width:400px;margin:auto" class="container">

		<h1 align="center">Register</h1>
		<div class="input-container">
			<i class="fa fa-user icon"></i>
			<input class="input-field" type="text" placeholder="Enter name" name="name" pattern="[A-Za-z, ]{4,}" title="Only letters and white space allowed" autofocus required>
		</div>

		<div class="input-container">
			<i class="fa fa-envelope icon"></i>
			<input class="input-field" type="text" placeholder="Enter email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email format" required>
		</div>
		
		<div class="input-container">
			<i class="fa fa-phone icon"></i>
			<input class="input-field" type="text" placeholder="Enter number " name="mobile" pattern="[0-9]{10}" title="Please enter valid number." required>
		</div>
  
		<div class="input-container">
			<i class="fa fa-lock icon"></i>
			<input class="input-field" type="password" id="pwd" placeholder="Create Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
			<input type="checkbox" onclick="Showpwd()">
		</div>
  
		<div class="input-container">
			<i class="fa fa-lock icon"></i>
			<input class="input-field" type="password" id="cpwd" placeholder="Confirm Password" name="cpassword" required>
			<input type="checkbox" onclick="Showpwd1()">
		</div>

		<button type="submit" class="btn" name="submit">Register Now</button>
		<p>Already have an account?&nbsp;&nbsp;<a href="Index.php">Log in.</a></p>
	</form>
	<br><br><br>
	</div>
</body>
	<!--   Show password function---------------- -->
	
	<script>
	function Showpwd() 
		{
			var x = document.getElementById("pwd");
			if (x.type === "password") 
			{
				x.type = "text";
			} 
			else 
			{
				x.type = "password";
			}
		}
	</script>
	
	<script>
	function Showpwd1() 
		{
			var x = document.getElementById("cpwd");
			if (x.type === "password") 
			{
				x.type = "text";
			} 
			else 
			{
				x.type = "password";
			}
		}
	</script>
</html>
