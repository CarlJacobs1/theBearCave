<?php
namespace Classes;
require_once $_SERVER['DOCUMENT_ROOT'] .'/Composer/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/Include/dbConnection.php';


use Classes\user;

class userStats extends user {
    public $total_open_maintenance_requests;
    public $total_open_maintenance_requests_for_user;

    public function mapuserStatsFields($userStats) {
        $this->total_open_maintenance_requests          = $userStats->total_open_maintenance_requests;
        $this->total_open_maintenance_requests_for_user = $userStats->total_open_maintenance_requests_for_user;
    }

    public function getHomePageStatistics($user_id) {

        $sql       = "call userGetLoginStats('$user_id');";
        $result    = executeQuery($sql);
        $userStats = $result->fetchObject(__NAMESPACE__ . '\\userStats');
        $this->mapuserStatsFields($userStats);
    }
}

?>