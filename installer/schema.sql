
CREATE TABLE IF NOT EXISTS `gameNews` (
  `GN_id` int(11) NOT NULL AUTO_INCREMENT,
  `GN_author` int(11) NOT NULL DEFAULT 0,
  `GN_title` varchar(120) NULL,
  `GN_text` text NULL,
  `GN_date` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`GN_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `notifications` (
  `N_id` int(11) NOT NULL AUTO_INCREMENT,
  `N_uid` int(11) NOT NULL DEFAULT 0,
  `N_time` int(11) NOT NULL DEFAULT 0,
  `N_text` text NULL,
  `N_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`N_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `settings` (
  `S_id` int(11) NOT NULL AUTO_INCREMENT,
  `S_desc` varchar(255) NULL,
  `S_value` text NULL,
  PRIMARY KEY (`S_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `U_id` int(11) NOT NULL AUTO_INCREMENT,
  `U_name` varchar(30) NULL,
  `U_email` varchar(100) NULL,
  `U_password` varchar(255) NOT NULL DEFAULT '',
  `U_userLevel` int(1) NULL,
  `U_status` int(1) NULL,
  PRIMARY KEY (`U_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userStats` (
  `US_id` int(11) NOT NULL PRIMARY KEY,
  `US_street` varchar(255) NOT NULL DEFAULT '',
  `US_line2` varchar(255) NOT NULL DEFAULT '',
  `US_city` varchar(255) NOT NULL DEFAULT '',
  `US_county` varchar(255) NOT NULL DEFAULT '',
  `US_postcode` varchar(255) NOT NULL DEFAULT '',
  `US_billStreet` varchar(255) NOT NULL DEFAULT '',
  `US_billLine2` varchar(255) NOT NULL DEFAULT '',
  `US_billCity` varchar(255) NOT NULL DEFAULT '',
  `US_billCounty` varchar(255) NOT NULL DEFAULT '',
  `US_billPostcode` varchar(255) NOT NULL DEFAULT ''
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userTimers` (
  `UT_user` int(11) NOT NULL DEFAULT 0,
  `UT_desc` varchar(32) NULL,
  `UT_time` int(11) NOT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `roleAccess` ( 
  `RA_role` INT NOT NULL , 
  `RA_module` VARCHAR(128) NOT NULL,
  PRIMARY KEY(`RA_role`, `RA_module`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userRoles` (
  `UR_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `UR_desc` varchar(128) NULL,
  `UR_color` varchar(7) NOT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `forums` ( 
  `F_id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT , 
  `F_sort` INT(11) NOT NULL DEFAULT 0,
  `F_name` VARCHAR(128)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `forumAccess` ( 
  `FA_role` INT(11), 
  `FA_forum` INT(11)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `topics` ( 
  `T_id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT , 
  `T_date` INT(11), 
  `T_forum` INT(11), 
  `T_user` INT(11), 
  `T_subject` VARCHAR(128),
  `T_type` INT(11),
  `T_status` INT(11)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `posts` ( 
  `P_id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT , 
  `P_topic` INT(11), 
  `P_date` INT(11), 
  `P_user` INT(11), 
  `P_body` TEXT
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `topicReads` ( 
  `TR_topic` INT(11), 
  `TR_user` INT(11)
) DEFAULT CHARSET=utf8;