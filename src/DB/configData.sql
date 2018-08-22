#######################################################################################################
#######################################################################################################
# System User
#######################################################################################################
#######################################################################################################
INSERT INTO users
( id
, first_name
, second_name
, last_name
, username
, password
, active_ind 
, failed_login_attempts
)
VALUES 
( '45b320c3-942c-11e8-9b63-ac220b15705f'
, 'system'
, NULL 
, 'system'
, 'system'
, '$2y$10$NerRX2jeUkefVTpJHBsqQuXOzR93bISUHGidaY5oXMZvSFVmYyUmG'
, '1'
, '0'
, 'active'
);

#######################################################################################################
#######################################################################################################
# Password System Config
#######################################################################################################
#######################################################################################################

#system_config_groups
insert into system_config_groups
( id
, constant
, display_name
, description
, active_ind 
)
VALUES
( 'b0c69d3b-942c-11e8-9b63-ac220b15705f'
, 'SYS_CONF_GRP_PASSWORD_POLICY'
, 'Password Policy'
, 'A set of system configuration settings that will govern the bear cave password policy, e.g. max number of login attempts, number of characters in new password, etc.'
, '1'
);

#settings for the group
insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( '8d850bb0-942d-11e8-9b63-ac220b15705f'
, 'b0c69d3b-942c-11e8-9b63-ac220b15705f'
, 'SYS_CONF_MAX_LOGIN_ATTEMPTS'
, 'Maximum Allowed Login Attempts'
, '5'
, '1'
);

insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( '156adad2-98c9-11e8-9b63-ac220b15705f'
, 'b0c69d3b-942c-11e8-9b63-ac220b15705f'
, 'SYS_CONF_USER_TOKEN_EXPIRY'
, 'User Creation Token Expiry (in hours)'
, '24'
, '1'
);


#######################################################################################################
#######################################################################################################
# Email System Config
#######################################################################################################
#######################################################################################################

#system_config_groups
insert into system_config_groups
( id
, constant
, display_name
, description
, active_ind 
)
VALUES
( '0e31ff51-98d7-11e8-9b63-ac220b15705f'
, 'SYS_CONF_GRP_EMAIL_DETAILS'
, 'Email Config'
, 'A set of system configuration settings that will be used to send emails from the system.'
, '1'
);

#settings for the group
insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( '39f04ee1-98d7-11e8-9b63-ac220b15705f'
, '0e31ff51-98d7-11e8-9b63-ac220b15705f'
, 'SYS_CONF_FROM_EMAIL_ADDRESS'
, 'From Email Address'
, 'theBearCaveTesting@gmail.com'
, '1'
);

#settings for the group
insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( '65244f91-98d7-11e8-9b63-ac220b15705f'
, '0e31ff51-98d7-11e8-9b63-ac220b15705f'
, 'SYS_CONF_REPLY_EMAIL_ADDRESS'
, 'Reply Email Address'
, 'theBearCaveTesting@gmail.com'
, '1'
);

#settings for the group
insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( '5d316326-9a7d-11e8-a89b-ac220b15705f'
, '0e31ff51-98d7-11e8-9b63-ac220b15705f'
, 'SYS_CONF_EMAIL_PASSWORD'
, 'Email Password'
, 'theBearCaveTesting@c8978a40-9a7c-11e8-a89b-ac220b15705f'
, '1'
);

#settings for the group
insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( '907835a6-9bd2-11e8-a89b-ac220b15705f'
, '0e31ff51-98d7-11e8-9b63-ac220b15705f'
, 'SYS_CONFIG_EMAIL_ALIAS'
, 'Email Alias'
, 'The Bear Cave'
, '1'
);

insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( 'f27f6acb-9bda-11e8-a89b-ac220b15705f'
, '0e31ff51-98d7-11e8-9b63-ac220b15705f'
, 'SYS_CONFIG_EMAIL_HOST'
, 'Email Host'
, 'smtp.gmail.com'
, '1'
);


insert into system_config
( id 
, system_config_group_id 
, constant
, display_name 
, value 
, active_ind 
)
VALUES
( '29cb13c7-9bdb-11e8-a89b-ac220b15705f'
, '0e31ff51-98d7-11e8-9b63-ac220b15705f'
, 'SYS_CONFIG_EMAIL_PORT'
, 'Email Port'
, '465'
, '1'
);
