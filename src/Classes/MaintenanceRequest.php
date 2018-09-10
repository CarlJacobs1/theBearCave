<?php
namespace Classes;
require_once $_SERVER['DOCUMENT_ROOT'] .'/Composer/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/Include/dbConnection.php';


class maintenanceRequest{
	const MR_STATUS_ACTIVE = 'active';
	const MR_STATUS_INACTIVE = 'inactive';
	const MR_STATUS_COMPLETED = 'complete';
	const MR_STATUS_DUPLICATE = 'duplicate';
	
	private id;
	private name;
	private description;
	private priority;
	private location;
	private request_start_date;
	private create_date;
	private create_user_id;
	private last_update_date;
	private last_update_user_id;
	private status;
}


?>