<?php

require "../Composer/vendor/autoload.php";

use Classes\userCreationToken;
use Classes\userLogin;

if (isset($_POST['login'])) {
    $user = new userLogin($_POST['username'], $_POST['password']);
    $user->userLogin();

    #check if the user could be matched to a username in the system.
    if ($user->loggedIn == false) {
        echo '<p>Incorrect username or password.</p>';
        #check whether the user is inactive
    } elseif ($user->status == userLogin::USER_STATUS_DEACTIVATED) {
        echo '<p>User is deactivated.</p>';
        #check if the maxuimum number of login attempts have been reached for the user
    } elseif ($user->loggedIn == '1') {
        echo '<p>Maximum number of password retries reached.</p>';
        #log the user in
    } elseif ($user->loggedIn == '3') {
        echo '<p>User is pending activation.</p>';
        #log the user in
    } elseif ($user->loggedIn == '4') {
        echo '<p>User is currently deactivated.</p>';
        #log the user in
    } elseif ($user->loggedIn == '2') {
        $user->setUserLoginSession();
        header("Location: home.php");
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