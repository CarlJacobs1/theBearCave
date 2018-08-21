<!DOCTYPE html>
<html>
<head>
	<title>New User Registration</title>
</head>
<body>

	<div>
		<h2>New User Registration</h2>
		<form action="newUser.php" method="post">
			<p>
				<span>
					<label>Email Address*: </label>
					<input type="text" name="username">
				</span>
			</p>
			<p>
				<span>
					<label>First Name*:</label>
					<input type="text" name="first_name">
				</span>
			</p>

			<p>
				<span>
					<label>Second Name:</label>
					<input type="text" name="second_name">
				</span>
			</p>
			<p>
				<span>
					<label>Last Name*:</label>
					<input type="text" name="last_name">
				</span>
			</p>
			<p>
				<input type="submit" name="createUser">
			</p>
		</form>
	</div>
	<?php
	include('../Include/users/newUserRegistration.php');
	?>
</body>
</html>