<!DOCTYPE html>
<html>
<head>
	<title>The Bear Cave Login</title>
	<link rel="icon" type="image/png" href="./favIcon.png">
	<link rel="stylesheet" href="./CSS/material.min.css">
	<script src="./CSS/material.min.js"></script>
</head>
<body>

	<div class="mdl-layout mdl-js-layout">
		<div class="mdl-card mdl-shadow--6dp">
			<div class="mdl-card__title mdl-color--primary mdl-color-text--white" >
				<h2 class="mdl-card__title-text">Bear Cave Entrance</h2>
			</div>
			<form action="login.php" method="post">
				<div class="mdl-card__actions">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input  class="mdl-textfield__input" type="text" name="username" id="username">
						<label class="mdl-textfield__label" for="username"> Username</label>
					</div>

					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

						<input  class="mdl-textfield__input" type="password" name="password" id="password">
						<label class="mdl-textfield__label" for="password">Password</label>
					</div>

				</div>
				<div class="mdl-card__actions">
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored type="submit"  name='login'>Login</button>
					<a href="./newUser.php">Register New User</a>

				</div>
			</form>
			<?php
			include('../Include/loginHandler.php');

			?>
			
		</div>
		

	</div>

	<!--
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
		
	</div>
-->


</body>




</html>