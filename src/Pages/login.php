<!DOCTYPE html>
<html>
<head>
	<title>The Bear Cave Login</title>
	<link rel="icon" type="image/png" href="./favIcon.png">
	<link rel="stylesheet" type="text/css" href="./CSS/login.css">
</head>
<body>
	
	<div class="login">
		<div class="heading">
			<h2>Sign in</h2>
			<form action="login.php" method="post">
				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input  class="form-control" type="text" name="username" placeholder="Username">
				</div>

				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					<input  class="form-control"type="password" name="password" placeholder="Password">
				</div>

				<button type="submit" class="float" name='login'>Login</button>
			</form>
			<a href="./newUser.php">Register New User</a>
		</div>
		<?php
		include('../Include/loginHandler.php');

		?>
	</div>

	
</body>




</html>