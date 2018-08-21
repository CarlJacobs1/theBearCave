#####################################################################################################
#####################################################################################################
#system configuration
#####################################################################################################
#####################################################################################################
DROP TABLE IF EXISTS system_config_groups;
CREATE TABLE system_config_groups
( id                      varchar(36) NOT NULL PRIMARY KEY 
, constant                varchar(100)
, display_name            varchar(100) not null
, description             varchar(255)
, active_ind              varchar(1) not null
, index constant (constant)
);

DROP TABLE IF EXISTS system_config;
CREATE TABLE system_config
( id                                       varchar(36) NOT NULL PRIMARY KEY 
, system_config_group_id                   varchar(36) not null
, constant                                 varchar(100)
, display_name                             varchar(100) not null
, value                                    text
, active_ind                               varchar(100)
, FOREIGN KEY (system_config_group_id) REFERENCES system_config_groups(id)
, index system_config_group_id (system_config_group_id)
, index constant (constant)
);


#####################################################################################################
#####################################################################################################
#users
#####################################################################################################
#####################################################################################################
DROP TABLE IF EXISTS users;
CREATE TABLE users 
( id                       varchar(36) NOT NULL PRIMARY KEY 
, first_name               varchar(100) NOT NULL 
, second_name              varchar(100)
, last_name                varchar(100)
, username                 varchar(100)
, password                 varchar(100)
, active_ind               varchar(1) NOT NULL
, failed_login_attempts    int(5) NOT NULL 
, status varchar(100)
, index id (id)
, index username (username)
);


DROP TABLE IF EXISTS users_history;
CREATE TABLE users_history
( id                       varchar(36) NOT NULL PRIMARY KEY 
, user_id                  varchar(36)  NOT NULL 
, first_name               varchar(100)
, second_name              varchar(100)
, last_name                varchar(100)
, username                 varchar(100)
, password                 varchar(100)
, FOREIGN KEY (user_id) REFERENCES users(id)
, index id (id)
, index user_id(user_id)
);

DROP TABLE IF EXISTS user_login_history;
CREATE TABLE user_login_history
( id                       varchar(36) NOT NULL PRIMARY KEY 
, user_id                  varchar(36) NOT NULL 
, date                     datetime 
, description              varchar(100)
, FOREIGN KEY (user_id) REFERENCES users(id)
, index id (id)
, index user_id (user_id)
, index date (date)
);


DROP TABLE IF EXISTS user_creation_tokens;
CREATE TABLE user_creation_tokens
( id varchar(36) PRIMARY KEY 
, token varchar(36) NOT NULL 
, user_id varchar(36) NOT NULL 
, expiry_date datetime NOT NULL
, FOREIGN KEY (user_id) REFERENCES users(id)
, INDEX user_id(user_id)
, INDEX expiry_date(expiry_date)
);
