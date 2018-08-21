<?php

namespace Classes;
require '../Composer/vendor/autoload.php';
require_once '../Include/dbConnection.php';

use Classes\systemConfig;

#require_once '/systemConfig.php';
 class userCreationToken {
    Public $id;
    Public $token;
    Public $user_id;
    Public $expiry_date;

    Public function insertUserCreationToken() {
        $this->determineUserTokenExpiryDate();
        $conn        = createConnection();
        $queryString = "call userCreationTokensCreate( ";
        $queryString .= "'$this->user_id'";
        $queryString .= ",'$this->expiry_date'";
        $queryString .= ", @id";
        $queryString .= ", @token";
        $queryString .= ");";
        $result      = executeQuery($queryString, $conn);
        $queryString = "select @id as id, @token as token;";
        $result      = executeQuery($queryString, $conn);
        $tokenDetail = $result->fetchObject(__NAMESPACE__ . '\\userCreationToken');
        $this->id    = $tokenDetail->id;
        $this->token = $tokenDetail->token;

    }

    Public function determineUserTokenExpiryDate() {
        $tokenExpirySysConfig     = new systemConfig();
        $tokenExpirySysConfig->id = systemConfig::SYS_CONF_USER_TOKEN_EXPIRY;
        $tokenExpirySysConfig->getConfigById();
        $timeString        = "+  $tokenExpirySysConfig->value hours";
        $this->expiry_date = date("Y-m-d H:i:s", strToTime($timeString));

    }
}

?>