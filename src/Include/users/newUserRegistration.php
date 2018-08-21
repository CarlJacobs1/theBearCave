<?php
require "../Composer/vendor/autoload.php";
use Classes\userCreation;
if (isset($_POST['createUser'])) {
    $user = new userCreation($_POST['first_name']
        , $_POST['second_name']
        , $_POST['last_name']
        , $_POST['username']
        , userCreation::USER_CREATION_METHOD_EMAIL);

    $errors = $user->validateProvidedData();

    if (empty($errors)) {
        $user->createUser();

        if ($user->userCreationResult == userCreation::USER_ALREADY_EXISTS) {
            echo '<p>' . 'Username: ' . $user->username . ' already exists. Unable to create user</p>';
        }

        if ($user->userCreationResult == userCreation::USER_CREATION_SUCCESSFULL) {
            echo '<p>An email has been sent to the following email address: ' . $user->username . '</p>';
            echo '<p>Please follow the instructions in the email to complete the registration process.</p>';
        }
    } else {
        echo '<br>';
        echo '<p>Please address the following issues: </p>';

        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }

    }

}

?>