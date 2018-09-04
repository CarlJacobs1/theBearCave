<!DOCTYPE html>
<html>
<head>
	<title>New User Registration</title>
	<script type="text/javascript" src="./JS/NewUser/NewUser.js"></script>
</head>
<body>
	<div>
		<h2>New User Registration</h2>
		<form action="newUser.php" method="post">
			<p>
				<span>
					<label>Email Address *: </label>
					<input type="text" name="username" id="username" onkeyup="validateFormData()">
				</span>
			</p>
			<p>
				<span> 
					<label>First Name *:</label>
					<input type="text" name="first_name" id="first_name" onkeyup="validateFormData()">
				</span>
			</p>

			<p>
				<span>
					<label>Second Name:</label>
					<input type="text" name="second_name" id="second_name" onkeyup="validateFormData()">
				</span>
			</p>
			<p>
				<span>
					<label>Last Name *:</label>
					<input type="text" name="last_name" id="last_name" onkeyup="validateFormData()">
				</span>
			</p>
			<p>
				<span>
					<label>Password *:</label>
					<input type="password" name="password" id="password" onkeyup="validateFormData()">
				</span>
			</p>
			<p>
				<span>
					
					<label>Confirm Password *: </label>
					<input type="password" name="password2" id="password2" onkeyup="validateFormData()">
				</span>
			</p>
			<p>
				<label name="password_confirmation_label" id="password_confirmation_label"></label>
			</p>
			<p>
				<input type="submit" name="createUser" id="createUser" disabled="disabled">
			</p>
		</form>
	</div>
	<?php
	include('../Include/users/newUserRegistration.php');
	?>
	
	
</body>
</html>