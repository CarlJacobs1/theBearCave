<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/Composer/vendor/autoload.php';
use Classes\maintenanceRequest;

$mr = new maintenanceRequest();                             
$mr->id = 'da64d02a-b6bf-11e8-a895-ac220b15705f';

var_dump($mr);

$mr->getMaintenanceRequestById();


var_dump($mr);
?>