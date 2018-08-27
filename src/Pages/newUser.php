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
	<script type="text/javascript">

		function validateFormData(){
			var username = document.getElementById('username').value;
			var first_name = document.getElementById('first_name').value;
			var last_name = document.getElementById('last_name').value;
			var password = document.getElementById('password').value;
			var password2 = document.getElementById('password2').value;
			var password_confirmation_label = document.getElementById('password_confirmation_label');
			var createUser = document.getElementById('createUser');
			var validationBoolean = 1;

			if (username == '') {
				validationBoolean = 0;
			}

			if (first_name == '') {
				validationBoolean = 0;
			}

			if (last_name == '') {
				validationBoolean = 0;
			}

			if (password == '') {
				validationBoolean = 0;
			}

			if (password2 == '') {
				validationBoolean = 0;
			}

			if (password2 == '') {
				password_confirmation_label.setAttribute('hidden','hidden')
			} else{
				password_confirmation_label.removeAttribute('hidden','hidden')
				if (password !== password2) {
					password_confirmation_label.innerHTML = 'Passwords do not match';
					validationBoolean = 0;

				} else{
					password_confirmation_label.innerHTML = 'Passwords Match!';
				}
			}

			if (validationBoolean == 0) {
				createUser.setAttribute('disabled', 'disabled');

			} else{
				createUser.removeAttribute('disabled', 'disabled');

			}

		}

	</script>
	
</body>
</html>