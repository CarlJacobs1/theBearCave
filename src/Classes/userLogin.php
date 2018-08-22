<?php
namespace Classes;
require '../Composer/vendor/autoload.php';
require_once '../Include/dbConnection.php';

use Classes\user;
use Classes\systemConfig;



 class userLogin extends user {
    Public $providedUsername;
    Public $providedPassword;
    Public $loggedIn;

    Public function __construct($username, $password) {
        $this->providedUsername = $username;
        $this->providedPassword = $password;
        $this->loggedIn         = false;

    }

    Public function userLogin() {
        $this->getUserByUsername($this->providedUsername);
        #check if a user is returned
        if (!empty($this->id)) {
            $max_login_attempts = $this->getMaxLoginAttempts();
            $max_login_attempts = $max_login_attempts['0']['value'];
            if ($this->failed_login_attempts >= $max_login_attempts) {
                $this->loggedIn = '1';
                return $this;
            }
            if (password_verify($this->providedPassword, $this->password)) {
                $this->createUserLoginHistory();
                $this->failed_login_attempts = 0;
                $this->updateFailedLoginAttempts();
                $this->loggedIn = '2';
                return $this;
            } else {
                $this->failed_login_attempts = $this->failed_login_attempts + 1;
                $this->updateFailedLoginAttempts();
                return $this;
            }
        } else {
            return $this;
        }

    }

    Public function createUserLoginHistory() {

        $sql = "call createUserLoginHistory( ";
        $sql .= "uuid(), ";
        $sql .= "'$this->id', ";
        $sql .= "current_timestamp, ";
        $sql .= "'User (" . $this->username . ") has logged in.');";
        $result = executeQuery($sql);
    }

    private function updateFailedLoginAttempts() {
        $sql = "call updateUserFailedLoginAttempt( ";
        $sql .= "'$this->id', ";
        $sql .= "'$this->failed_login_attempts');";
        $conn = executeQuery($sql);
    }

    public function getMaxLoginAttempts() {
        $sql = "call getSystemConfigById( '";
        $sql .= systemConfig::SYS_CONF_MAX_LOGIN_ATTEMPTS;
        $sql .= "');";
        $conn = executeQuery($sql);
        $loginAttempts = $conn->fetchAll();
        return $loginAttempts;
    }

    public function setUserLoginSession(){
        session_start();
        $_SESSION['username']   = $this->username;
        $_SESSION['first_name'] = $this->first_name;
        $_SESSION['last_name']  = $this->last_name;
        $_SESSION['id']         = $this->id;
        $_SESSION['login_time'] = strtotime('+20 minutes', strtotime(date('d-m-Y H:i:s')));
    }

}

?>