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
	, failed_login_attempts
	FROM users
	WHERE username = in_username;	
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
