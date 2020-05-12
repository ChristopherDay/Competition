CREATE TABLE IF NOT EXISTS `pages` (
   `P_id` int(11) NOT NULL AUTO_INCREMENT,
   `P_url` varchar(120) NOT NULL,
   `P_title` varchar(120) NOT NULL,
   `P_text` text NOT NULL,
   PRIMARY KEY (`P_id`)
) DEFAULT CHARSET=utf8;