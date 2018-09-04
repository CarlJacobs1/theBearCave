<?php
namespace Classes;
require '../Composer/vendor/autoload.php';
require_once '../Include/dbConnection.php';

use Classes\user;
use Classes\userCreationToken;

class userCreation extends user {
#user creation methods
    const USER_CREATION_METHOD_EMAIL = 'email';

    #user Creation Results
    const USER_CREATION_SUCCESSFULL = '0';
    const USER_ALREADY_EXISTS       = '1';

    public $userCreationResult;
    public $token;
    public $userCreationMethod;

    public function __Construct($first_name
        , $second_name
        , $last_name
        , $username
        , $password
        , $creationMethod) {
        $this->first_name            = $first_name;
        $this->second_name           = $second_name;
        $this->last_name             = $last_name;
        $this->username              = $username;
        $this->password              = password_hash($password,PASSWORD_BCRYPT);
        $this->active_ind            = '0';
        $this->failed_login_attempts = '0';
        $this->status                = user::USER_STATUS_PENDING;
        $this->creationMethod        = $creationMethod;

    }

    public function createUser() {

        #check if a user with the provided username already exists in the database.
        $userAlreadyExist = new user();
        $userAlreadyExist->getUserByUsername($this->username);
        if (!empty($userAlreadyExist->id)) {
            $this->userCreationResult = userCreation::USER_ALREADY_EXISTS;
            return $this;
        }

        if ($this->creationMethod == userCreation::USER_CREATION_METHOD_EMAIL) {
            #set status to pending and create user.
            $this->status = user::USER_STATUS_PENDING;
            $this->insertUsers();

            #Create User Token
            $userCreationToken          = new userCreationToken();
            $userCreationToken->user_id = $this->id;
            $userCreationToken->insertUserCreationToken();

            #send Email to provided email address
            $this->sendRegistrationEmail($userCreationToken);

        } else {
            $this->status = user::USERS_STATUS_ACTIVE;
            $this->insertUsers();
        }

        if (isset($this->id)) {
            $this->userCreationResult = userCreation::USER_CREATION_SUCCESSFULL;
        }

    }

    Public function validateProvidedData() {
        $errors = array();
        #Provided username must be a valid email address. This will also check that a value is provided
        if (!filter_var($this->username, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, '"' . $this->username . '" is not a valid email address.');

        }

        #a firstname must be provided.
        if (empty($this->first_name)) {
            array_push($errors, 'First Name is a required field.');
        }

        # a lastname must be provided
        if (empty($this->last_name)) {
            array_push($errors, 'Last Name is a required field.');
        }

        return $errors;

    }

    public function sendRegistrationEmail($userCreationToken) {

        $mail = new email($this->username, 'The Bear Cave - New User Registration', email::getHTMLEmailFromFile(email::HTML_MAIL_NEW_USER_REGISTRATION), true);
        $mail->message = str_replace('<<tokenPlaceholder>>', $userCreationToken->token, $mail->message);
        $mail->sendEmail();

    }
}
?>