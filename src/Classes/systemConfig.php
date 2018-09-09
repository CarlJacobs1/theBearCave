<?php

namespace Classes;
require '../../Composer/vendor/autoload.php';
require_once '../../Include/dbConnection.php';

class systemConfig {

#Email Constants
    const SYS_CONF_GRP_EMAIL_DETAILS   = '0e31ff51-98d7-11e8-9b63-ac220b15705f';
    const SYS_CONF_FROM_EMAIL_ADDRESS  = '39f04ee1-98d7-11e8-9b63-ac220b15705f';
    const SYS_CONF_REPLY_EMAIL_ADDRESS = '65244f91-98d7-11e8-9b63-ac220b15705f';
    const SYS_CONF_EMAIL_ALIAS         = '907835a6-9bd2-11e8-a89b-ac220b15705f';
    const SYS_CONF_EMAIL_PASSWORD      = '5d316326-9a7d-11e8-a89b-ac220b15705f';
    const SYS_CONFIG_EMAIL_HOST        = 'f27f6acb-9bda-11e8-a89b-ac220b15705f';
    const SYS_CONFIG_EMAIL_PORT        = '29cb13c7-9bdb-11e8-a89b-ac220b15705f';

#Password Policy Constants
    const SYS_CONF_GRP_PASSWORD_POLICY = 'b0c69d3b-942c-11e8-9b63-ac220b15705f';
    const SYS_CONF_MAX_LOGIN_ATTEMPTS  = '8d850bb0-942d-11e8-9b63-ac220b15705f';
    const SYS_CONF_USER_TOKEN_EXPIRY   = '156adad2-98c9-11e8-9b63-ac220b15705f';

    public $id;
    public $system_config_group_id;
    public $constant;
    public $display_name;
    public $value;
    public $active_ind;

    public function getConfigById() {
        $sql = "call getSystemConfigById( '";
        $sql .= $this->id;
        $sql .= "');";
        $result                       = executeQuery($sql);
        $systemConfig                 = $result->fetchObject(__NAMESPACE__ . '\\systemConfig');
        $this->system_config_group_id = $systemConfig->system_config_group_id;
        $this->constant               = $systemConfig->constant;
        $this->display_name           = $systemConfig->display_name;
        $this->value                  = $systemConfig->value;
        $this->active_ind             = $systemConfig->active_ind;
    }

    #returns an array of system configuration entries for a system config group based on the group id.
    public function getConfigBySystemConfigGroupId($system_config_group_id) {
        $sql = "call getSystemConfigBySystemConfigGroupId( '";
        $sql .= $system_config_group_id;
        $sql .= "');";
        $result              = executeQuery($sql);
        $systemConfigEntires = array();
        $systemConfig        = $result->fetchAll();

        return $systemConfig;

    }
}
?>