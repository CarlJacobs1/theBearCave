function userLogin()
{
	var $username = document.getElementById('username').value;
	var $password = document.getElementById('password').value;
	var $loading_spinner = document.getElementById('loading_spinner');
	$loading_spinner.removeAttribute('hidden');
	var $ajax_request = newAjaxRequest()
	
	$ajax_request.onreadystatechange = function(){
		if($ajax_request.readyState == 4){
			$loading_spinner.setAttribute('hidden', 'hidden');
			userLoginToast($ajax_request.responseText);
			if ($ajax_request.responseText == 'User successfully logged in') {
				window.location.href = "home.php";
			}
			
		}
	};
	$ajax_query_string = 'login=login&username=' + $username + '&password=' + $password;
	sendAjaxRequest($ajax_request, "POST", "./Include/loginHandler.php", $ajax_query_string);

	$ajax_request.open("POST", "./Include/loginHandler.php", true);
	$ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	$ajax_request.send("login=login&username=" + $username + "&password=" + $password);
}

function userLoginToast($MsgToDisplay){
	var notification = document.querySelector('.mdl-js-snackbar');
	notification.MaterialSnackbar.showSnackbar(
  {
    message: $MsgToDisplay
  }
);
}
