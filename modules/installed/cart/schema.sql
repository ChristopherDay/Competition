CREATE TABLE IF NOT EXISTS `cart` (
   `CA_id` int(11) NOT NULL,
   `CA_comp` int(11) NOT NULL,
   `CA_ans` INT(11) NOT NULL,
   `CA_date` INT(11) NOT NULL,
   `CA_qty` INT(11) NOT NULL,
   PRIMARY KEY (`CA_id`, `CA_comp`, `CA_ans`)
) DEFAULT CHARSET=utf8;