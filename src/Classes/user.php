<?php
namespace Classes;
require_once $_SERVER['DOCUMENT_ROOT'] .'/Composer/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/Include/dbConnection.php';


#require_once '/systemConfig.php';
#require_once '/userCreationTokens.php';
#require_once '/email.php';

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
            $this->mapUserFields($user);
        }

    }
    public function userUpdateById(){
        $sql = "call userUpdateById( ";
        $sql .= "'$this->id',";
        $sql .= "'$this->first_name',";
        $sql .= "'$this->second_name',";
        $sql .= "'$this->last_name',";
        $sql .= "'$this->username',";
        $sql .= "'$this->password',";
        $sql .= "'$this->active_ind',";
        $sql .= "'$this->failed_login_attempts',";
        $sql .= "'$this->status'";
        $sql .= ");";
        $result = executeQuery($sql);
    }

    public function userGetById(){
        $sql = "call userGetById( ";
        $sql .= "'$this->id'";
        $sql .= ");";
        $result = executeQuery($sql);
        $user   = $result->fetchObject(__NAMESPACE__ . '\\user');
        $this->mapUserFields($user);

    }

    public function mapUserFields($user) {
        $this->id                    = $user->id;
        $this->first_name            = $user->first_name;
        $this->second_name           = $user->second_name;
        $this->last_name             = $user->last_name;
        $this->username              = $user->username;
        $this->password              = $user->password;
        $this->active_ind            = $user->active_ind;
        $this->status                = $user->status;
        $this->failed_login_attempts = $user->failed_login_attempts;

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
