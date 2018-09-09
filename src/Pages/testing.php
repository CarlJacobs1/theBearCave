<!DOCTYPE html>
<html>
<head>
	<title>Testing</title>
</head>
<body>

	<script>
		function test()
		{
			var $username = document.getElementById('username').value;
			var $password = document.getElementById('password').value;
			var $passedorfailed = document.getElementById('passedorfailed');
			$passedorfailed.removeAttribute('hidden', 'hidden');
			$passedorfailed.innerHTML = 'loading';
			var $ajax_request = new XMLHttpRequest();
			$ajax_request.onreadystatuschange = function(){
				if(this.readystate == 4 && this.status == '200'){
					passedorfailed.innerHTML = this.responseText;
				}
			};

			$ajax_request.open("POST", "./Include/loginHandler.php", true);
			$ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			$ajax_request.send("login=login&username=" + $username + "&password=" + $password);
			console.log('Message Sent');
		}
	</script>

	<input type="text" name="username" id="username">
	<input type="text" name="password" id="password">
	<input type="submit" name="login" id="login" onclick="test();">

	<label id="passedorfailed" name="passedorfailed" hidden="hidden"></label>



</body>
</html>