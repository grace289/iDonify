<?php
	$msg = "";

	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'root', '', 'db_idonify');

		//$name = $con->real_escape_string($_POST['name']);
		//$email = $con->real_escape_string($_POST['email']);
		//$password = $con->real_escape_string($_POST['password']);
		//$cPassword = $con->real_escape_string($_POST['cPassword']);
		
		$fname = $con->real_escape_string($_POST['fname']);
		$lname = $con->real_escape_string($_POST['lname']);
		$email = $con->real_escape_string($_POST['email']);
		$pwd1 = $con->real_escape_string($_POST['pwd1']);
		$pwd2 = $con->real_escape_string($_POST['pwd2']);
		$userRole = "user";
		
		if ($pwd1 != $pwd2)
			$msg = "Please Check Your Passwords!";
		else {
			$hash = password_hash($pwd1, PASSWORD_BCRYPT);
			$con->query("INSERT INTO users (user_fname, user_lname,user_email, user_password, user_role) 
						VALUES ('$fname', '$lname', '$email', '$hash', '$userRole')");
			$msg = "You have been registered!";
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img src="assets/images/logo.png"><br><br>

				<?php if ($msg != "") echo $msg . "<br><br>"; ?>
				
				<h1>Registration</h1><br>
				<form method="post" action="register.php">
					<input class="form-control" minlength="3" type="text" name="fname" value="" placeholder="First Name"><br>
					<input class="form-control" type="text" name="lname" value="" placeholder="Last Name"><br>
					<input class="form-control" type="text" name="email" value="" placeholder="Email"><br>
					<input class="form-control" minlength="5" type="password" name="pwd1" value="" placeholder="Password"><br>
					<input class="form-control" minlength="5" type="password" name="pwd2" value="" placeholder="Confirm Password"><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Register"><br>
				</form>

			</div>
		</div>
	</div>
</body>
</html>