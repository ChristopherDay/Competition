CREATE TABLE IF NOT EXISTS `competitions` (
   `C_id` int(11) NOT NULL AUTO_INCREMENT,
   `C_date` INT(11) NOT NULL,
   `C_title` varchar(120) NOT NULL,
   `C_text` text NOT NULL,
   `C_maxTickets` INT(11) NOT NULL DEFAULT 0,
   `C_maxPurchase` INT(11) NOT NULL DEFAULT 0,
   `C_cost` FLOAT(11, 2) NOT NULL DEFAULT 0.00,
   `C_question` varchar(255) NOT NULL,
   `C_ans1` varchar(120) NOT NULL,
   `C_ans2` varchar(120) NOT NULL,
   `C_ans3` varchar(120) NOT NULL,
   `C_correct` int(11) NOT NULL,
   PRIMARY KEY (`C_id`)
) DEFAULT CHARSET=utf8;