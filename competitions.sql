-- MySQL dump 10.13  Distrib 8.0.18, for osx10.15 (x86_64)
--
-- Host: localhost    Database: competitions
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `CA_id` int(11) NOT NULL,
  `CA_comp` int(11) NOT NULL,
  `CA_ans` int(11) NOT NULL,
  `CA_date` int(11) NOT NULL,
  `CA_qty` int(11) NOT NULL,
  PRIMARY KEY (`CA_id`,`CA_comp`,`CA_ans`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (2,0,0,1586257702,0),(3,0,0,1586257774,0),(4,0,0,1586257822,0);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competitions`
--

DROP TABLE IF EXISTS `competitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competitions` (
  `C_id` int(11) NOT NULL AUTO_INCREMENT,
  `C_date` int(11) NOT NULL,
  `C_title` varchar(120) NOT NULL,
  `C_text` text NOT NULL,
  `C_maxTickets` int(11) NOT NULL DEFAULT '0',
  `C_maxPurchase` int(11) NOT NULL DEFAULT '0',
  `C_cost` float(11,2) NOT NULL DEFAULT '0.00',
  `C_question` varchar(255) NOT NULL,
  `C_ans1` varchar(120) NOT NULL,
  `C_ans2` varchar(120) NOT NULL,
  `C_ans3` varchar(120) NOT NULL,
  `C_correct` int(11) NOT NULL,
  PRIMARY KEY (`C_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competitions`
--

LOCK TABLES `competitions` WRITE;
/*!40000 ALTER TABLE `competitions` DISABLE KEYS */;
INSERT INTO `competitions` VALUES (1,1587385800,'Test Competition','<p>Just a test competition!</p><p>You can use the <b><u>HTML</u></b> editor to easily change the styles of text.&nbsp;</p>',250,25,2.50,'Who makes the iPhone?','Apple','Google','Microsoft',1),(2,1586176200,'Old Competition','<p>This was in the past and is now <b><u>locked!</u></b></p>',200,20,3.50,'Is this Locked?','Yes','No','Maybe',1);
/*!40000 ALTER TABLE `competitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FAQ`
--

DROP TABLE IF EXISTS `FAQ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `FAQ` (
  `FAQ_id` int(11) NOT NULL AUTO_INCREMENT,
  `FAQ_title` varchar(120) NOT NULL,
  `FAQ_text` text NOT NULL,
  PRIMARY KEY (`FAQ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FAQ`
--

LOCK TABLES `FAQ` WRITE;
/*!40000 ALTER TABLE `FAQ` DISABLE KEYS */;
INSERT INTO `FAQ` VALUES (1,'Test FAQ item','Just some test text.'),(2,'Can you easily add questions?','Yes there is a very simple and easy to use Admin panel for it');
/*!40000 ALTER TABLE `FAQ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumAccess`
--

DROP TABLE IF EXISTS `forumAccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forumAccess` (
  `FA_role` int(11) DEFAULT NULL,
  `FA_forum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumAccess`
--

LOCK TABLES `forumAccess` WRITE;
/*!40000 ALTER TABLE `forumAccess` DISABLE KEYS */;
/*!40000 ALTER TABLE `forumAccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forums`
--

DROP TABLE IF EXISTS `forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forums` (
  `F_id` int(11) NOT NULL AUTO_INCREMENT,
  `F_sort` int(11) NOT NULL DEFAULT '0',
  `F_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`F_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forums`
--

LOCK TABLES `forums` WRITE;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` VALUES (1,1,'Forum');
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gameNews`
--

DROP TABLE IF EXISTS `gameNews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gameNews` (
  `GN_id` int(11) NOT NULL AUTO_INCREMENT,
  `GN_author` int(11) NOT NULL DEFAULT '0',
  `GN_title` varchar(120) DEFAULT NULL,
  `GN_text` text,
  `GN_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`GN_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gameNews`
--

LOCK TABLES `gameNews` WRITE;
/*!40000 ALTER TABLE `gameNews` DISABLE KEYS */;
/*!40000 ALTER TABLE `gameNews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `N_id` int(11) NOT NULL AUTO_INCREMENT,
  `N_uid` int(11) NOT NULL DEFAULT '0',
  `N_time` int(11) NOT NULL DEFAULT '0',
  `N_text` text,
  `N_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`N_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `P_id` int(11) NOT NULL AUTO_INCREMENT,
  `P_url` varchar(120) NOT NULL,
  `P_title` varchar(120) NOT NULL,
  `P_text` text NOT NULL,
  PRIMARY KEY (`P_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'about','About Us','<p>Some text about your company goes here, there is a easy to use <b>HTML</b> editor you can use.</p>'),(2,'TOS','Terms Of Service','<p>Your T&amp;C\'s go here, this is easily edited in the admin panel</p>'),(3,'privacy','Privacy Policy','<p>Your privacy policy goes here, this is easily edited in the admin panel!</p>'),(4,'home','Home Page','<p>Your home page will go here</p>');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `P_id` int(11) NOT NULL AUTO_INCREMENT,
  `P_topic` int(11) DEFAULT NULL,
  `P_date` int(11) DEFAULT NULL,
  `P_user` int(11) DEFAULT NULL,
  `P_body` text,
  PRIMARY KEY (`P_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,1586175502,1,'A test forum post');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roleAccess`
--

DROP TABLE IF EXISTS `roleAccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roleAccess` (
  `RA_role` int(11) NOT NULL,
  `RA_module` varchar(128) NOT NULL,
  PRIMARY KEY (`RA_role`,`RA_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roleAccess`
--

LOCK TABLES `roleAccess` WRITE;
/*!40000 ALTER TABLE `roleAccess` DISABLE KEYS */;
INSERT INTO `roleAccess` VALUES (2,'*');
/*!40000 ALTER TABLE `roleAccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `S_id` int(11) NOT NULL AUTO_INCREMENT,
  `S_desc` varchar(255) DEFAULT NULL,
  `S_value` text,
  PRIMARY KEY (`S_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'validateUserEmail','1'),(2,'game_name','Company Name'),(3,'theme','default'),(4,'adminTheme','admin'),(5,'landingPage','home'),(6,'loginSuffix',''),(7,'loginPostfix',''),(8,'registerSuffix',''),(9,'registerPostfix',''),(10,'from_email','no-reply@yourcompany.com'),(11,'pointsName','');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topicReads`
--

DROP TABLE IF EXISTS `topicReads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topicReads` (
  `TR_topic` int(11) DEFAULT NULL,
  `TR_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topicReads`
--

LOCK TABLES `topicReads` WRITE;
/*!40000 ALTER TABLE `topicReads` DISABLE KEYS */;
/*!40000 ALTER TABLE `topicReads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topics` (
  `T_id` int(11) NOT NULL AUTO_INCREMENT,
  `T_date` int(11) DEFAULT NULL,
  `T_forum` int(11) DEFAULT NULL,
  `T_user` int(11) DEFAULT NULL,
  `T_subject` varchar(128) DEFAULT NULL,
  `T_type` int(11) DEFAULT NULL,
  `T_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`T_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,1586175502,1,1,'Test Forum Post',NULL,NULL);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userRoles`
--

DROP TABLE IF EXISTS `userRoles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userRoles` (
  `UR_id` int(11) NOT NULL AUTO_INCREMENT,
  `UR_desc` varchar(128) DEFAULT NULL,
  `UR_color` varchar(7) NOT NULL,
  PRIMARY KEY (`UR_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userRoles`
--

LOCK TABLES `userRoles` WRITE;
/*!40000 ALTER TABLE `userRoles` DISABLE KEYS */;
INSERT INTO `userRoles` VALUES (1,'User','#000000'),(2,'Admin','#0f00ff'),(3,'Banned','#FF0000');
/*!40000 ALTER TABLE `userRoles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `U_id` int(11) NOT NULL AUTO_INCREMENT,
  `U_name` varchar(30) DEFAULT NULL,
  `U_email` varchar(100) DEFAULT NULL,
  `U_password` varchar(255) NOT NULL DEFAULT '',
  `U_userLevel` int(1) DEFAULT NULL,
  `U_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`U_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'cday','chris@cdcoding.com','c5cd110b619e8f9761da4577134fdb10443d814570d63e8c442e3279b201f286',2,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userStats`
--

DROP TABLE IF EXISTS `userStats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userStats` (
  `US_id` int(11) NOT NULL,
  `US_street` varchar(255) NOT NULL DEFAULT '',
  `US_line2` varchar(255) NOT NULL DEFAULT '',
  `US_city` varchar(255) NOT NULL DEFAULT '',
  `US_county` varchar(255) NOT NULL DEFAULT '',
  `US_postcode` varchar(255) NOT NULL DEFAULT '',
  `US_billStreet` varchar(255) NOT NULL DEFAULT '',
  `US_billLine2` varchar(255) NOT NULL DEFAULT '',
  `US_billCity` varchar(255) NOT NULL DEFAULT '',
  `US_billCounty` varchar(255) NOT NULL DEFAULT '',
  `US_billPostcode` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`US_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userStats`
--

LOCK TABLES `userStats` WRITE;
/*!40000 ALTER TABLE `userStats` DISABLE KEYS */;
INSERT INTO `userStats` VALUES (1,'58 Wildfield Close','Wood Street Village','Guildford','Surrey','GU3 3EQ','58 Wildfield Close','Wood Street Village','Guildford','Surrey','GU3 3EQ');
/*!40000 ALTER TABLE `userStats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userTimers`
--

DROP TABLE IF EXISTS `userTimers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userTimers` (
  `UT_user` int(11) NOT NULL DEFAULT '0',
  `UT_desc` varchar(32) DEFAULT NULL,
  `UT_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userTimers`
--

LOCK TABLES `userTimers` WRITE;
/*!40000 ALTER TABLE `userTimers` DISABLE KEYS */;
INSERT INTO `userTimers` VALUES (1,'signup',1586106753),(1,'laston',1586284884),(1,'forumMute',1586175501),(1,'forumTopic',1586175562);
/*!40000 ALTER TABLE `userTimers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-07 19:44:09
