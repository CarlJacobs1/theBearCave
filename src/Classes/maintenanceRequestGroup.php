<?php
namespace Classes;
require_once $_SERVER['DOCUMENT_ROOT'] .'/Composer/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/Include/dbConnection.php';

class maintenanceRequestGroup{
	const MRG_STATUS_ACTIVE = 'active';
	const MRG_STATUS_INACTIVE = 'inactive';

	Public $id;
    Public $name;
    Public $description;
    Public $create_date;
    Public $create_user_id;
    Public $last_update_date;
    Public $last_update_user_id;
    Public $status;

}

?>