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

DROP TABLE IF EXISTS user_maintenance_groups;
CREATE TABLE user_maintenance_groups 
( id                                      varchar(36) NOT NULL PRIMARY KEY 
, user_id                                 varchar(36) NOT NULL 
, maintenance_request_group_id            varchar(36) NOT NULL 
, INDEX user_maintenance_groups(user_id, maintenance_request_group_id)
, FOREIGN KEY (user_id) REFERENCES users(id)
, FOREIGN KEY (maintenance_request_group_id) REFERENCES maintenance_request_groups(id)
);

#####################################################################################################
#####################################################################################################
#maintenance_requests
#####################################################################################################
#####################################################################################################
#maintenance_request_groups
DROP TABLE IF EXISTS maintenance_request_groups;
CREATE TABLE maintenance_request_groups
( id                                   varchar(36) PRIMARY KEY 
, name                                 varchar(100) NOT NULL 
, description                          text
, create_date                          datetime NOT NULL 
, create_user_id                       varchar(36) NOT NULL 
, last_update_date                     datetime NOT NULL 
, last_update_user_id                  varchar(36) NOT NULL 
, status                               varchar(50) NOT NULL 
, INDEX name(name)
, INDEX status(status)
, FOREIGN KEY (create_user_id) REFERENCES users(id)
, FOREIGN KEY (last_update_user_id) REFERENCES users(id)
);

#maintenance_requests
DROP TABLE IF EXISTS maintenance_requests;
CREATE TABLE maintenance_requests
( id                                    varchar(36) PRIMARY key
, name                                  varchar(255) NOT NULL 
, description                           text NOT NULL 
, maintenance_request_group_id          varchar(36) NOT NULL 
, priority                              varchar(50)
, location                              varchar(255) NOT NULL 
, request_start_date                    datetime NOT NULL 
, create_date                           datetime NOT NULL 
, create_user_id                        varchar(36) NOT NULL 
, last_update_date                      datetime NOT NULL 
, last_update_user_id                   varchar(36) NOT NULL 
, status                                varchar(50) NOT NULL 
, INDEX name(name)
, INDEX priority(priority)
, INDEX status(status)
, FOREIGN KEY (maintenance_request_group_id) REFERENCES maintenance_request_groups(id)
, FOREIGN KEY (create_user_id) REFERENCES users(id)
, FOREIGN KEY (last_update_user_id) REFERENCES users(id)
);


#maintenance_request_invoices
DROP TABLE IF EXISTS maintenance_request_invoices;
CREATE TABLE maintenance_request_invoices
( id 									varchar(36) PRIMARY KEY 
, maintenance_request_id 				varchar(255) NOT NULL 
, supplier_id 							varchar(36)
, create_date 							datetime NOT NULL 
, create_user_id 						varchar(36) NOT NULL 
, last_update_date 						datetime NOT NULL 
, last_update_user_id 					varchar(36) NOT NULL 
, status 								varchar(50) NOT NULL 
, INDEX maintenance_request_id(maintenance_request_id)
, INDEX supplier_id(supplier_id)
, INDEX status(status)
, FOREIGN KEY (maintenance_request_id) REFERENCES maintenance_requests(id)
, FOREIGN KEY (create_user_id) REFERENCES users(id)
, FOREIGN KEY (last_update_user_id) REFERENCES users(id)
);

DROP TABLE IF EXISTS user_maintenance_groups;
CREATE TABLE user_maintenance_groups 
( id                                      varchar(36) NOT NULL PRIMARY KEY 
, user_id                                 varchar(36) NOT NULL 
, maintenance_request_group_id            varchar(36) NOT NULL 
, INDEX user_maintenance_groups(user_id, maintenance_request_group_id)
);



#####################################################################################################
#####################################################################################################
#files
#####################################################################################################
#####################################################################################################
#files
DROP TABLE IF EXISTS files;
CREATE TABLE files
( id                                      varchar(36) PRIMARY KEY 
, entity_type                             varchar(100) NOT NULL 
, entity_id                               varchar(36) NOT NULL 
, file_name                               text
, sha1hash                                varchar(100) NOT NULL 
, file_extension                          varchar(50)
, mime_type                               varchar(255) 
, create_date                             datetime NOT NULL 
, create_user_id                          varchar(36) NOT NULL 
, last_update_date                        datetime NOT NULL 
, last_update_user_id                     varchar(36) NOT NULL 
, status                                  varchar(50) NOT NULL 
, INDEX id(id)
, INDEX entity(entity_type, entity_id)
, INDEX status(status)
, FOREIGN KEY (create_user_id) REFERENCES users(id)
, FOREIGN KEY (last_update_user_id) REFERENCES users(id)
);

#comments
DROP TABLE IF EXISTS comments;
CREATE TABLE comments
( id                                     varchar(36) PRIMARY KEY 
, entity_type                            varchar(100) NOT NULL 
, entity_id                              varchar(36) NOT NULL 
, comment                                text NOT NULL 
, create_date                            datetime NOT NULL 
, create_user_id                         varchar(36) NOT NULL 
, last_update_date                       datetime NOT NULL 
, last_update_user_id                    varchar(36) NOT NULL 
, status                                 varchar(50) NOT NULL 
, INDEX id(id)
, INDEX entity(entity_type, entity_id)
, INDEX status(status)
, FOREIGN KEY (create_user_id) REFERENCES users(id)
, FOREIGN KEY (last_update_user_id) REFERENCES users(id)
);