<!DOCTYPE html>
<html>
<head>
	<title>The Bear Cave Login</title>
	<link rel="icon" type="image/png" href="../favIcon.png">
	<link rel="stylesheet" href="./CSS/material.min.css">
	<script src="./CSS/material.min.js"></script>
	<script src="./JS/User/userLogin.js"></script>
</head>
<body>

	<div class="mdl-layout mdl-js-layout">
		<div class="mdl-card mdl-shadow--6dp">
			<div class="mdl-card__title mdl-color--primary mdl-color-text--white" >
				<h2 class="mdl-card__title-text">Bear Cave Entrance</h2>
			</div>

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
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored type="submit"  name='login' onclick="userLogin()">Login</button>
				<div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active" hidden="hidden" id="loading_spinner"></div>
				<a href="./newUser.php">Register New User</a>

			</div>


			<!-- <?php
			#include('./Include/loginHandler.php');

			?> -->
			
		</div>
		

	</div>

<div id="login_result_toast" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>	

</body>




</html>