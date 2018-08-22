<?php

require "../Composer/vendor/autoload.php";

use Classes\userLogin;

if (isset($_POST['login'])) {
    $user     = new userLogin($_POST['username'], $_POST['password']);
    $user->userLogin();
    #check if the user could be matched to a username in the system.
    if ($user->loggedIn == false) {
        echo '<p>Incorrect Username or Password.</p>';
        #check whether the user is inactive
    } elseif ($user->active_ind == '0') {
        echo '<p>User is inactive.</p>';
        #check if the maxuimum number of login attempts have been reached for the user
    } elseif ($user->loggedIn == '1') {
        echo '<p>Maximum Number of Password Retries Reached.</p>';
        #log the user in
    } elseif ($user->loggedIn == '2') {
        $user->setUserLoginSession();
        header("Location: home.php");
    }
}
?>