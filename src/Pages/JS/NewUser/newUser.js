
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