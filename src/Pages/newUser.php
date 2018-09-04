<!DOCTYPE html>
<html>
<head>
	<title>New User Registration</title>
	<link rel="stylesheet" href="./CSS/material.min.css">
	<script src="./CSS/material.min.js"></script>
	<script  src="./JS/NewUser/newUser.js"></script>	
</head>
<body>
	<div class="mdl-layout mdl-js-layout">
		<div class="mdl-card mdl-shadow--6dp">
			<div class="mdl-card__title mdl-color--primary mdl-color-text--white" >
				<h2 class="mdl-card__title-text">Enter User Details</h2>
			</div>
			
			<form action="newUser.php" method="post">
				<div class="mdl-card__actions">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="username" id="username" onkeyup="validateFormData()">
						<label class="mdl-textfield__label" for="username">Email Address *: </label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

						<input class="mdl-textfield__input" type="text" name="first_name" id="first_name" onkeyup="validateFormData()">
						<label class="mdl-textfield__label" for="first_name">First Name *:</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

						<input class="mdl-textfield__input" type="text" name="second_name" id="second_name" onkeyup="validateFormData()">
						<label class="mdl-textfield__label" for="second_name">Second Name:</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

						<input class="mdl-textfield__input" type="text" name="last_name" id="last_name" onkeyup="validateFormData()">
						<label class="mdl-textfield__label" for="last_name">Last Name *:</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

						<input class="mdl-textfield__input" type="password" name="password" id="password" onkeyup="validateFormData()">
						<label class="mdl-textfield__label" for="password">Password *:</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

						<input class="mdl-textfield__input"  type="password" name="password2" id="password2" onkeyup="validateFormData()">
						<label class="mdl-textfield__label" for="password2">Confirm Password *: </label>
					</div>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit"  name='createUser' id="createUser" disabled="disabled">Submit</button>
					<label name="password_confirmation_label" id="password_confirmation_label"></label>
				</div>
			</form>
			<?php
			include('../Include/users/newUserRegistration.php');
			?>
		</div>

	</div>

	

<!--
	<div>
		<h2>New User Registration</h2>
		<form action="newUser.php" method="post">
			<p>
				<span>
					
				</span>
			</p>
			<p>
				<span> 
					
				</span>
			</p>

			<p>
				<span>
					
				</span>
			</p>
			<p>
				<span>
					
				</span>
			</p>
			<p>
				<span>
					
				</span>
			</p>
			<p>
				<span>
					
					
				</span>
			</p>
			<p>
				
			</p>
			<p>
				<input type="submit" name="createUser" id="createUser" disabled="disabled">
			</p>
		</form>
	</div>
-->


</body>
</html>