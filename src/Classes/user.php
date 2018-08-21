<?php

namespace Classes;
require '../Composer/vendor/autoload.php';

require_once '../Include/dbConnection.php';

#require_once '/systemConfig.php';
#require_once '/userCreationTokens.php';
#require_once '/email.php';
use Classes\email;
use Classes\systemConfig;
use Classes\userCreationToken;

/**
 *
 */

class user {

    #User Status Constants
    const USERS_STATUS_ACTIVE     = 'active';
    const USER_STATUS_PENDING     = 'pending_activation';
    const USER_STATUS_DEACTIVATED = 'deactivated';





    public $id;
    public $first_name;
    public $second_name;
    public $last_name;
    public $username;
    public $password;
    public $active_ind;
    public $failed_login_attempts;
    public $status;


    

    public function getUserByUsername($inputUsername) {
        $sql = "CALL getUserByUsername ( ";
        $sql .= "'$inputUsername');";
        $result = executeQuery($sql);
        $user   = $result->fetchObject(__NAMESPACE__ . '\\user');
        if (isset($user->id)) {
            $this->id                    = $user->id;
            $this->first_name            = $user->first_name;
            $this->second_name           = $user->second_name;
            $this->last_name             = $user->last_name;
            $this->username              = $user->username;
            $this->password              = $user->password;
            $this->active_ind            = $user->active_ind;
            $this->failed_login_attempts = $user->failed_login_attempts;
        }

    }

    public function insertUsers() {
        $querystring = 'call usersCreate(';
        $querystring .= " @out_id";
        $querystring .= ", '$this->first_name'";
        $querystring .= ", '$this->second_name'";
        $querystring .= ", '$this->last_name'";
        $querystring .= ", '$this->username'";
        $querystring .= ", '$this->password'";
        $querystring .= ", '$this->active_ind'";
        $querystring .= ", '$this->failed_login_attempts'";
        $querystring .= ", '$this->status'";
        $querystring .= "); ";

        $conn = createConnection();

        $result = executeQuery($querystring, $conn);

        $querystring = 'select @out_id as id;';

        $result = executeQuery($querystring, $conn);

        $id = $result->fetchObject(__NAMESPACE__ . '\\user');

        $this->id = $id->id;
    }

   

}
