##########################################################################################################################
##########################################################################################################################
##############################################*****Users*****#############################################################
##########################################################################################################################
##########################################################################################################################
DROP PROCEDURE IF EXISTS getUserByUsername;
CREATE PROCEDURE getUserByUsername( IN in_username varchar(100))
BEGIN
	SELECT
	  id
	, first_name
	, second_name
	, last_name
	, username
	, `password`
	, active_ind
	, status
	, failed_login_attempts
	FROM users
	WHERE username = in_username;
END ;


DROP PROCEDURE IF EXISTS userUpdateById;
CREATE PROCEDURE userUpdateById( IN in_id varchar(100)
                               , in_first_name varchar(100)
                               , in_second_name varchar(100)
                               , in_last_name varchar(100)
                               , in_username varchar(100)
                               , in_password varchar(100)
                               , in_active_ind varchar(1)
                               , in_failed_login_attempts int
                               , in_status varchar(100)
                               )
BEGIN
	update users
	SET 
	  first_name = in_first_name
	, second_name = in_second_name
    , last_name = in_last_name
    , username = in_username
    , password = in_password
    , active_ind = in_active_ind
    , failed_login_attempts = in_failed_login_attempts
    , status = in_status
	WHERE id = in_id;
END ;




DROP PROCEDURE IF EXISTS createUserLoginHistory;
CREATE PROCEDURE createUserLoginHistory( IN in_id varchar(36),IN in_user_id varchar(36),IN in_date datetime,IN in_description varchar(100))
BEGIN
	INSERT INTO user_login_history
	( id
	, user_id
	, `date`
	, description)
	VALUES
	( in_id
	, in_user_id
	, in_date
	, in_description);
END


DROP PROCEDURE IF EXISTS updateUserFailedLoginAttempt;
CREATE PROCEDURE updateUserFailedLoginAttempt(IN in_id varchar(36),IN in_failed_login_attempts int)
BEGIN
	UPDATE users
	SET failed_login_attempts = in_failed_login_attempts
	WHERE id = in_id;
END

DROP PROCEDURE IF EXISTS usersCreate;
CREATE PROCEDURE usersCreate ( OUT out_id varchar(36)
                             , IN in_first_name varchar(100)
                             , IN in_second_name varchar(100)
                             , IN in_last_name varchar(100)
                             , IN in_username varchar(100)
                             , IN in_password varchar(100)
                             , IN in_active_ind varchar(1)
                             , IN in_failed_login_attempts int(5)
                             , IN in_status varchar(100)
                             )
BEGIN
	SET out_id = uuid();
	INSERT INTO users
	( id
	, first_name
	, second_name
	, last_name
	, username
	, `password`
	, active_ind
	, failed_login_attempts
	, status
	)
	VALUES
	( out_id
	, in_first_name
	, in_second_name
	, in_last_name
	, in_username
	, in_password
	, in_active_ind
	, in_failed_login_attempts
	, in_status
	);
END

DROP PROCEDURE IF EXISTS userCreationTokensCreate;
CREATE PROCEDURE userCreationTokensCreate( IN in_user_id varchar(36)
                                         , IN in_expiry_date datetime
                                         , OUT out_id varchar(36)
                                         , OUT out_token varchar(36)
                                         )
BEGIN

	SET out_id = uuid();
	SET out_token = uuid();


	INSERT INTO user_creation_tokens
	( id
	, token
	, user_id
	, expiry_date
	)
	VALUES
	( out_id
	, out_token
	, in_user_id
	, in_expiry_date);
END

DROP PROCEDURE IF EXISTS userCreationTokenGetByToken;
CREATE PROCEDURE userCreationTokenGetByToken( IN in_token varchar(36)
                                         )
BEGIN

	SELECT *
	FROM user_creation_tokens
	WHERE token = in_token;
END


##########################################################################################################################
##########################################################################################################################
#########################################*****System Config*****##########################################################
##########################################################################################################################
##########################################################################################################################

DROP PROCEDURE IF EXISTS getSystemConfigById;
CREATE PROCEDURE getSystemConfigById(IN in_id varchar(36))
BEGIN
	SELECT *
	FROM system_config
	WHERE id = in_id;
END

DROP PROCEDURE IF EXISTS getSystemConfigBySystemConfigGroupId;
CREATE PROCEDURE getSystemConfigBySystemConfigGroupId(IN in_system_config_group_id varchar(36))
BEGIN
	SELECT *
	FROM system_config
	WHERE system_config_group_id = in_system_config_group_id;
END


##########################################################################################################################
##########################################################################################################################
############################################*****User Stats*****##########################################################
##########################################################################################################################
##########################################################################################################################
DROP PROCEDURE IF EXISTS userGetLoginStats;
CREATE PROCEDURE userGetLoginStats(  IN in_user_id varchar(36)
                                  )
BEGIN 
    DECLARE total_open_maintenance_requests int;
	DECLARE total_open_maintenance_requests_for_user int;

	
	SET total_open_maintenance_requests = (SELECT count(*) 
	                                      FROM maintenance_requests a
	                                      INNER JOIN user_maintenance_groups b
	                                            ON a.maintenance_request_group_id = b.maintenance_request_group_id
	                                            AND b.user_id = in_user_id
	                                      WHERE a.status = 'active');
	SET total_open_maintenance_requests_for_user = (SELECT count(*) 
	                                      FROM maintenance_requests a
	                                      INNER JOIN user_maintenance_groups b
	                                            ON a.maintenance_request_group_id = b.maintenance_request_group_id
	                                            AND b.user_id = in_user_id
	                                      WHERE a.status = 'active'
	                                      AND create_user_id = in_user_id); 
	SELECT total_open_maintenance_requests
	     , total_open_maintenance_requests_for_user;
END;

##########################################################################################################################
##########################################################################################################################
########################################*****Maintenance Requests*****####################################################
##########################################################################################################################
##########################################################################################################################
DROP PROCEDURE IF EXISTS maintenaceRequstCreate;
CREATE PROCEDURE maintenaceRequstCreate ( OUT out_id varchar(36)
                                        , IN in_name                                  varchar(255)
                                        , IN in_description                           text
                                        , IN in_maintenance_request_group_id          varchar(36)  
                                        , IN in_priority                              varchar(50)
                                        , IN in_location                              varchar(255)
                                        , IN in_request_start_date                    datetime
                                        , IN in_create_date                           datetime
                                        , IN in_create_user_id                        varchar(36) 
                                        , IN in_last_update_date                      datetime 
                                        , IN in_last_update_user_id                   varchar(36) 
                                        , IN in_status                                varchar(50)
                                        )
BEGIN
	SET out_id = uuid();
	INSERT INTO maintenance_requests
	( id
    , name
    , description
    , maintenance_request_group_id
    , priority
    , location
    , request_start_date
    , create_date
    , create_user_id
    , last_update_date
    , last_update_user_id
    , status
	)
	VALUES
	( out_id
    , in_name
    , in_description
    , in_maintenance_request_group_id
    , in_priority
    , in_location
    , in_request_start_date
    , in_create_date
    , in_create_user_id
    , in_last_update_date
    , in_last_update_user_id
    , in_status
	);
END

DROP PROCEDURE IF EXISTS maintenanceRequestGetById;
CREATE PROCEDURE maintenanceRequestGetById ( IN in_id varchar(36)
                                           )
BEGIN
	SELECT *
	FROM maintenance_requests
	WHERE id = in_id;
END

DROP PROCEDURE IF EXISTS maintenanceRequestGroupsCreate;
CREATE PROCEDURE maintenanceRequestGroupCreate ( OUT out_id varchar(36)
                                               , IN in_name varchar(46)
                                               , IN in_description text
                                               , IN in_create_date datetime
                                               , IN in_create_user_id varchar(36)
                                               , IN in_last_update_date datetime
                                               , IN in_last_update_user_id varchar(36)
                                               , IN in_status varchar(50)                                        
                                        )
BEGIN
	SET out_id = uuid();
	INSERT INTO maintenance_request_groups
	( id
    , name
    , description
    , create_date
    , create_user_id
    , last_update_date
    , last_update_user_id
    , status
	)
	VALUES
	( out_id
    , in_name
    , in_description
    , in_create_date
    , in_create_user_id
    , in_last_update_date
    , in_last_update_user_id
    , in_status
	);
END