<?php

require "../../Composer/vendor/autoload.php";

use Classes\userCreationToken;
use Classes\userLogin;

if (isset($_POST['login'])) {
    $user = new userLogin($_POST['username'], $_POST['password']);
    $user->userLogin();

    #check if the user could be matched to a username in the system.
    if ($user->loggedIn == false) {
        echo 'Incorrect username or password.';
        #check whether the user is inactive
    } elseif ($user->status == userLogin::USER_STATUS_DEACTIVATED) {
        echo 'User is deactivated.';
        #check if the maxuimum number of login attempts have been reached for the user
    } elseif ($user->loggedIn == '1') {
        echo 'Maximum number of password retries reached.';
        #log the user in
    } elseif ($user->loggedIn == '3') {
        echo 'User is pending activation.';
        #log the user in
    } elseif ($user->loggedIn == '4') {
        echo 'User is currently deactivated.';
        #log the user in
    } elseif ($user->loggedIn == '2') {
        $user->setUserLoginSession();
        echo 'User successfully logged in';
    }
}

if (isset($_GET['token'])) {
    $userToken = $_GET['token'];

    $userCreationToken        = new userCreationToken();
    $userCreationToken->token = $_GET['token'];
    $tokenValidationFeedback  = $userCreationToken->validateUserCreationToken();

    if ($tokenValidationFeedback == 'Token not found') {
        echo '<p>Your token no longer exists.</p>';
    }
    if ($tokenValidationFeedback == 'Token expired.') {
        echo '<p>Your token has expired.</p>';
    }
    if ($tokenValidationFeedback == 'User Activated.') {
        echo '<p>Your user has been activated.</p>';
    }
}

if(isset($_GET['logout'])){
    session_start();
    session_unset();
}
?>