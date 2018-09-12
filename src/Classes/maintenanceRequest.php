<?php
namespace Classes;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Composer/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Include/dbConnection.php';

class maintenanceRequest {
    const MR_STATUS_ACTIVE    = 'active';
    const MR_STATUS_INACTIVE  = 'inactive';
    const MR_STATUS_COMPLETED = 'complete';
    const MR_STATUS_DUPLICATE = 'duplicate';

    Public $id;
    Public $name;
    Public $description;
    Public $maintenance_request_group_id;
    Public $priority;
    Public $location;
    Public $request_start_date;
    Public $create_date;
    Public $create_user_id;
    Public $last_update_date;
    Public $last_update_user_id;
    Public $status;

    public function mapMaintenanceRequestFields($maintenanceRequest) {
        $this->id                           = $maintenanceRequest->id;
        $this->name                         = $maintenanceRequest->name;
        $this->description                  = $maintenanceRequest->description;
        $this->maintenance_request_group_id = $maintenanceRequest->maintenance_request_group_id;
        $this->priority                     = $maintenanceRequest->priority;
        $this->location                     = $maintenanceRequest->location;
        $this->request_start_date           = $maintenanceRequest->request_start_date;
        $this->create_date                  = $maintenanceRequest->create_date;
        $this->create_user_id               = $maintenanceRequest->create_user_id;
        $this->last_update_date             = $maintenanceRequest->last_update_date;
        $this->last_update_user_id          = $maintenanceRequest->last_update_user_id;
        $this->status                       = $maintenanceRequest->status;

    }

    public function CreateMaintenanceRequest() {
        $querystring = 'call maintenaceRequstCreate(';
        $querystring .= " @out_id";
        $querystring .= ", '$this->name'";
        $querystring .= ", '$this->description'";
        $querystring .= ", '$this->maintenance_request_group_id'";
        $querystring .= ", '$this->priority'";
        $querystring .= ", '$this->location'";
        $querystring .= ", '$this->request_start_date'";
        $querystring .= ", '$this->create_date'";
        $querystring .= ", '$this->create_user_id'";
        $querystring .= ", '$this->last_update_date'";
        $querystring .= ", '$this->last_update_user_id'";
        $querystring .= ", '$this->status'";
        $querystring .= "); ";

        $conn = createConnection();

        $result = executeQuery($querystring, $conn);

        $querystring = 'select @out_id as id;';

        $result = executeQuery($querystring, $conn);

        $id = $result->fetchObject(__NAMESPACE__ . '\\maintenanceRequest');

        $this->id = $id->id;

    }

    Public function getMaintenanceRequestById(){  
        $sql = "call maintenanceRequestGetById( ";
        $sql .= "'$this->id'";
        $sql .= ");";
        $result = executeQuery($sql);
        $maintenanceRequest   = $result->fetchObject(__NAMESPACE__ . '\\maintenanceRequest');
        $this->mapMaintenanceRequestFields($maintenanceRequest);

    }

}

?>