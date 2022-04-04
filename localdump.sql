-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: rtc5531.encs.concordia.ca    Database: rtc55314
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) DEFAULT NULL,
  `file_location` varchar(1000) DEFAULT NULL,
  `thread_id` int DEFAULT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `uploaded_by` int NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES (3,'Cover_Letter_Template.pdf','/home/vikram/Documents/data/Personal/grad-dip-notes/comp5531/project/new_CGA/CGA/uploads/82b8adc7-551e-615c-98b6-bea936423e4bCover_Letter_Template.pdf',1,'2022-04-03 01:17:47',1),(4,'Vikram_Cover_letter.pdf','/home/vikram/Documents/data/Personal/grad-dip-notes/comp5531/project/new_CGA/CGA/uploads/63b52502-239b-c35d-0a52-9ab71365f374Vikram_Cover_letter.pdf',1,'2022-04-03 01:37:22',1),(5,'Vikram_Cover_letter.pdf','/home/vikram/Documents/data/Personal/grad-dip-notes/comp5531/project/new_CGA/CGA/uploads/58a6c2f6-cd2a-c539-7923-0ae23723d72fVikram_Cover_letter.pdf',1,'2022-04-03 01:38:38',1),(6,'Cover_Letter_Template.pdf','/home/vikram/Documents/data/Personal/grad-dip-notes/comp5531/project/new_CGA/CGA/uploads/88289c95-7b80-2bae-6173-ffe329132433Cover_Letter_Template.pdf',1,'2022-04-03 01:39:26',1),(7,'Cover_Letter_Template.pdf','/home/vikram/Documents/data/Personal/grad-dip-notes/comp5531/project/new_CGA/CGA/uploads/77d3412f-307e-6220-a944-e4ddbc32507fCover_Letter_Template.pdf',1,'2022-04-03 01:44:07',1),(8,'Cover_Letter_Template.pdf','/home/vikram/Documents/data/Personal/grad-dip-notes/comp5531/project/new_CGA/CGA/uploads/50b7f8b5-85a4-ed9d-76e0-056bbb03e948Cover_Letter_Template.pdf',1,'2022-04-03 01:47:18',1),(9,'db22j-prj-encr (1).pdf','C:/xampp/htdocsuploadsd41e2834-5351-0d98-2897-78b6feb7bd21db22j-prj-encr (1).pdf',1,'2022-04-03 17:29:55',1),(10,'db22j-prj-encr (1).pdf','C:/xampp/htdocsuploads29cbf22f-d8f2-6adb-69db-2cde7e5fb110db22j-prj-encr (1).pdf',1,'2022-04-03 17:31:05',1),(11,'jama_dimasi_2020_le_200056.pdf','C:/xampp/htdocs/uploads46e2159a-795e-8199-825d-4831e757b02fjama_dimasi_2020_le_200056.pdf',1,'2022-04-03 17:33:22',1),(12,'db22j-prj-encr (1).pdf','C:/xampp/htdocs/test-pr1-1/uploads087e6f9e-1acc-65ed-16cb-7574db82545cdb22j-prj-encr (1).pdf',1,'2022-04-03 17:41:33',1),(13,'db22j-prj-encr (1).pdf','C:/xampp/htdocs/test-pr1-1/uploads/80d3bf10-066a-ff7f-af7e-884cca95ebb5db22j-prj-encr (1).pdf',1,'2022-04-03 17:42:16',1),(14,'db22j-prj-encr (1).pdf','C:/xampp/htdocs/test-pr1-1/uploads/53beae4b-ff1c-0ac4-e267-fcaf9b287dd0db22j-prj-encr (1).pdf',1,'2022-04-03 17:44:41',1);
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `term` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course_desc` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'COMP 5531','Website and Database Design','Winter','2022','adkjoijglkds','0000-00-00','0000-00-00'),(2,'ENGL 101','Introduction to English','Fall','1999','oh no','0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_categories`
--

DROP TABLE IF EXISTS `forum_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `marked_entity_id` int NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `viewable_to` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `marked_entity_id_idx` (`marked_entity_id`),
  CONSTRAINT `marked_entity_id` FOREIGN KEY (`marked_entity_id`) REFERENCES `marked_entities` (`marked_entity_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_categories`
--

LOCK TABLES `forum_categories` WRITE;
/*!40000 ALTER TABLE `forum_categories` DISABLE KEYS */;
INSERT INTO `forum_categories` VALUES (1,1,'Public',',all,'),(2,1,'Private Chat - Group 2',',2,'),(3,2,'Public',',all,'),(4,3,'Public',',all,'),(5,3,'Private Chat - Group 1',',1,'),(6,3,'Private Chat - Group 2',',2,'),(7,4,'Public',',all,'),(8,4,'Private Chat - Group 2',',2,'),(9,5,'Public',',all,'),(13,6,'Public',',all,'),(14,7,'Public',',all,'),(15,7,'Private Chat - Group 1',',1,'),(16,8,'Public',',all,'),(17,9,'Public',',all,'),(18,10,'Public',',all,'),(28,11,'Public',',all,'),(29,11,'Private Chat - Group 1',',1,'),(30,11,'Private Chat - Group 2',',2,'),(31,11,'Private Chat - Group 3',',5,'),(32,11,'Private Chat - Group 4',',6,'),(33,11,'Private Chat - Group 5',',7,'),(34,11,'Private Chat - Group 1,2,3',',1,2,5,'),(35,12,'Public',',all,'),(36,12,'Private Chat - Group 1',',1,'),(37,12,'Private Chat - Group 2',',2,'),(38,12,'Private Chat - Group 3',',5,'),(39,12,'Private Chat - Group 4',',6,'),(40,12,'Private Chat - Group 5',',7,'),(42,13,'Public',',all,'),(43,13,'Private Chat - Group 1',',1,'),(44,14,'Public',',all,'),(45,14,'Private Chat - Group 1',',1,'),(46,15,'Public',',all,'),(47,15,'Private Chat - Group 1',',1,'),(48,16,'Public',',all,'),(49,16,'Private Chat - Group 1',',1,'),(50,17,'Public',',all,'),(51,17,'Private Chat - Group 1',',1,'),(52,18,'Public',',all,'),(53,18,'Private Chat - Group 1',',1,'),(54,19,'Public',',all,'),(55,19,'Private Chat - Group 2',',2,'),(56,20,'Public',',all,'),(57,20,'Private Chat - Group 1',',1,'),(58,21,'Public',',all,'),(59,21,'Private Chat - Group 1',',1,'),(60,22,'Public',',all,'),(61,22,'Private Chat - Group 1',',1,'),(62,23,'Public',',all,'),(63,23,'Private Chat - Group 1',',1,'),(64,23,'Public',',all,'),(65,23,'Private Chat - Group 1',',1,'),(85,24,'Public',',all,'),(86,25,'Public',',all,'),(87,26,'Public',',all,'),(88,27,'Public',',all,'),(89,28,'Public',',all,'),(90,29,'Public',',all,'),(91,30,'Public',',all,'),(92,31,'Public',',all,'),(93,32,'Public',',all,'),(94,33,'Public',',all,'),(95,34,'Public',',all,'),(96,35,'Public',',all,'),(97,36,'Public',',all,'),(98,37,'Public',',all,'),(99,38,'Public',',all,'),(100,38,'Private Chat - Group 1',',1,'),(101,39,'Public',',all,'),(102,39,'Private Chat - Group 2',',2,'),(103,40,'Public',',all,'),(104,40,'Private Chat - Group 2',',2,'),(105,41,'Public',',all,'),(106,41,'Private Chat - Group 1',',1,'),(107,42,'Public',',all,'),(108,43,'Public',',all,'),(109,44,'Public',',all,'),(110,45,'Public',',all,'),(111,45,'Private Chat - Group 1',',1,'),(112,46,'Public',',all,'),(113,47,'Public',',all,');
/*!40000 ALTER TABLE `forum_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_replies`
--

DROP TABLE IF EXISTS `forum_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_replies` (
  `reply_id` int NOT NULL AUTO_INCREMENT,
  `topic_id` int NOT NULL,
  `text` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `reply_by` int NOT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `topic_id_idx` (`topic_id`),
  CONSTRAINT `topic_id` FOREIGN KEY (`topic_id`) REFERENCES `forum_topics` (`topic_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_replies`
--

LOCK TABLES `forum_replies` WRITE;
/*!40000 ALTER TABLE `forum_replies` DISABLE KEYS */;
INSERT INTO `forum_replies` VALUES (1,1,'It\'s not due tomorrow. great.bye','2022-03-27 14:08:04',1),(2,2,'helppppppp','2022-03-27 14:39:58',1),(4,4,'this is so annoyingggggg','2022-03-27 14:44:25',1),(6,5,'This should hopefully work now?','2022-03-27 15:16:59',1),(7,6,'This should hopefully work now?','2022-03-27 15:17:59',1),(8,7,'Not sure what to do next','2022-03-31 23:31:07',1),(9,8,'Hey Group 2, was wondering when is this due?','2022-04-01 20:01:30',1),(10,9,'I am wondering when assignment 2 is due','2022-04-01 20:03:57',1),(11,10,'first','2022-04-01 20:05:06',1),(12,11,'hi public','2022-04-01 22:23:20',1),(17,12,'Hey, whats up','2022-04-02 00:16:40',1),(18,13,'My original post got banned. edited','2022-04-02 00:17:01',1),(19,13,'Why are we all in this chat','2022-04-02 01:24:12',1),(21,13,'i donn know','2022-04-02 00:25:12',3),(22,13,'i don\'t know','2022-04-02 00:28:07',3),(23,13,'are we in the same group?','2022-04-02 00:31:49',2),(24,13,'hello\r\ncan we do multiple para\r\ngraphs','2022-04-02 01:31:18',1),(30,14,'somehow i can still post','2022-04-03 22:50:01',1),(31,2,'should not view anymore after leaving group','2022-04-03 23:18:46',1),(32,1,'alllll','2022-04-03 23:47:34',1);
/*!40000 ALTER TABLE `forum_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_topics`
--

DROP TABLE IF EXISTS `forum_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_topics` (
  `topic_id` int NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `date` datetime NOT NULL,
  `topic_by` int NOT NULL,
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `topic_id_UNIQUE` (`topic_id`),
  KEY `category_id_idx` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `forum_categories` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_topics`
--

LOCK TABLES `forum_topics` WRITE;
/*!40000 ALTER TABLE `forum_topics` DISABLE KEYS */;
INSERT INTO `forum_topics` VALUES (1,'Due date is moved',1,'2022-03-27 14:04:14',1),(2,'another test',2,'2022-03-27 14:39:58',1),(4,'againnnn',3,'2022-03-27 14:44:25',1),(5,'Working?',3,'2022-03-27 15:16:59',1),(6,'Redirecting?',3,'2022-03-27 15:17:59',1),(7,'What do we do now?',1,'2022-03-31 23:31:07',1),(8,'Question about assignment 2',2,'2022-04-01 20:01:30',1),(9,'hey all',1,'2022-04-01 20:03:57',1),(10,'first post for assignment 3',14,'2022-04-01 20:05:06',1),(11,'hello public',4,'2022-04-01 22:23:20',1),(12,'Lets discuss group 1',29,'2022-04-02 00:16:40',1),(13,'WHY?????',34,'2022-04-02 00:17:01',1),(14,'bye i already left this group',2,'2022-04-03 22:50:01',1);
/*!40000 ALTER TABLE `forum_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_users`
--

DROP TABLE IF EXISTS `group_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_users` (
  `group_id` int NOT NULL,
  `user_id` int NOT NULL,
  `join_group_date` datetime NOT NULL,
  `left_group_date` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_users`
--

LOCK TABLES `group_users` WRITE;
/*!40000 ALTER TABLE `group_users` DISABLE KEYS */;
INSERT INTO `group_users` VALUES (1,1,'0000-00-00 00:00:00',NULL),(1,2,'0000-00-00 00:00:00','2022-04-02 00:00:00'),(1,3,'0000-00-00 00:00:00',NULL),(2,1,'0000-00-00 00:00:00',NULL),(3,1,'0000-00-00 00:00:00',NULL),(4,1,'0000-00-00 00:00:00',NULL),(6,4,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `group_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `group_id` int NOT NULL AUTO_INCREMENT,
  `section_id` int NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `leader_id` int NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,1,'Group 1',4,1),(2,1,'Group 2',4,1),(3,3,'Group 1',4,1),(4,3,'Group 2',4,1),(5,1,'Group 3',4,1),(6,1,'Group 4',4,1),(7,1,'Group 5',4,1),(8,1,'Group 6',4,1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marked_entities`
--

DROP TABLE IF EXISTS `marked_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marked_entities` (
  `marked_entity_id` int NOT NULL,
  `section_id` int NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_date` date NOT NULL,
  `due_date` date NOT NULL,
  `type` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `work_type` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `viewable_to` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_id` int DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`marked_entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marked_entities`
--

LOCK TABLES `marked_entities` WRITE;
/*!40000 ALTER TABLE `marked_entities` DISABLE KEYS */;
INSERT INTO `marked_entities` VALUES (1,1,'Assignment 1','2022-03-29','2022-04-02','asg','group',',2,',0,''),(2,1,'Project 20, previously Assignment 2 (edited)','2022-03-29','2022-04-28','proj','individual',',all,',0,'extended due date'),(3,1,'Project 1','2022-03-29','2022-04-01','proj','group',',1,2,',0,''),(4,1,'Quiz 1','2022-03-29','2022-04-08','other','group',',2,',0,''),(5,1,'Project 2','2022-03-30','2022-04-20','proj','individual',',all,',0,'Draft due'),(6,1,'Quiz 2','2022-03-30','2022-04-19','other','individual',',all,',0,''),(7,1,'Assignment 3','2022-03-30','2022-04-11','asg','group',',1,',0,''),(8,1,'Quiz 3','2022-03-30','2022-04-04','other','individual',',all,',0,''),(9,1,'Quiz 4','2022-03-30','2022-06-29','other','individual',',all,',0,''),(10,1,'Quiz 5','2022-03-30','2022-07-26','other','individual',',all,',0,''),(11,1,'Project 3','2022-04-02','2022-04-27','proj','group',',1,2,5,6,7,',0,'This project is group'),(12,1,'Project 4','2022-04-02','2022-05-06','proj','group',',1,2,5,6,7,',0,'lksdjfklsdjfkdsl'),(13,1,'sdfasf','2022-04-03','2022-04-28','asg','group',',1,',0,'sdsfs'),(14,1,'dfsaf','2022-04-03','2022-04-01','asg','group',',1,',0,'safdsff'),(15,1,'test123','2022-04-03','2022-04-06','asg','group',',1,',0,'sdfsdfss'),(16,1,'uploadtest1','2022-04-03','2022-04-06','asg','group',',1,',0,'uploadtest1'),(17,1,'uploadtest2','2022-04-03','2022-03-31','proj','group',',1,',0,'uploadtest2'),(18,1,'uploadtest3','2022-04-03','2022-04-06','asg','group',',1,',0,'uploadtest3'),(19,1,'uploadtest4','2022-04-03','2022-04-06','other','group',',2,',0,'uploadtest4'),(20,1,'uploadtest10','2022-04-03','2022-03-05','proj','group',',1,',0,'sdfsf'),(21,1,'uploadtest11','2022-04-03','2022-03-30','proj','group',',1,',0,'uploadtest11'),(22,1,'uploadtest12','2022-04-03','2022-04-14','asg','group',',1,',0,'uploadtest12'),(23,1,'uploadtest11','2022-04-03','2022-04-04','asg','group',',1,',8,'dfsadfsd'),(24,1,'test anne','2022-04-03','2022-04-20','other','individual',',all,',0,'test file upload'),(25,1,'test anne2','2022-04-03','2022-04-27','other','individual',',all,',0,'file included'),(26,1,'test anne3','2022-04-03','2022-04-28','other','individual',',all,',0,'file upload non encrypted'),(27,1,'sdfsdfsdf','2022-04-03','2022-04-27','asg','individual',',all,',0,''),(28,1,'sdfsdfsdfsdfsdfsdf','2022-04-03','2022-04-28','proj','individual',',all,',0,''),(29,1,'sdfsdfsdfsdfdddddd','2022-04-03','2022-04-28','other','individual',',all,',99,''),(30,1,'aaaaaaa','2022-04-03','2022-05-06','asg','individual',',all,',99,''),(31,1,'sdfsdfsdfsdfdddddd','2022-04-03','2022-04-27','asg','individual',',all,',99,''),(32,1,'adfsdfsdf','2022-04-03','2022-04-27','other','individual',',all,',99,''),(33,1,'gfggggg','2022-04-03','2022-05-03','proj','individual',',all,',200,''),(34,1,'sdfsdfdddddd','2022-04-03','2022-04-28','proj','individual',',all,',99,''),(35,1,'vvvvvv','2022-04-03','2022-04-29','proj','individual',',all,',99,''),(36,1,'sdeetwertyryr','2022-04-03','2022-04-27','asg','individual',',all,',101,''),(37,1,'dfsdfeerwer','2022-04-03','2022-04-19','asg','individual',',all,',9,''),(38,1,'sfasfsadf','2022-04-03','2022-04-12','asg','group',',1,',0,'safsadf'),(39,1,'rtereyery','2022-04-03','2022-05-04','asg','group',',2,',10,''),(40,1,'dfsdfsdrrrrr','2022-04-03','2022-05-04','other','group',',2,',11,''),(41,1,'hgkgyj','2022-04-03','2022-04-28','proj','group',',1,',101,''),(42,1,'jkjhkjhkjhk7867867','2022-04-03','2022-04-20','proj','individual',',all,',101,''),(43,1,'sdfdfsdfsdfsd','2022-04-03','2022-04-20','proj','individual',',all,',101,''),(44,1,'dfdfdfdf','2022-04-03','2022-04-28','asg','individual',',all,',12,''),(45,1,'safsadf','2022-04-03','2022-04-06','asg','group',',1,',0,'safsdwfas'),(46,1,'sdfsdfdddd','2022-04-03','2022-04-26','asg','individual',',all,',13,''),(47,1,'sdfdfffffff','2022-04-03','2022-04-26','proj','individual',',all,',14,'dfsdfsdf');
/*!40000 ALTER TABLE `marked_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marked_entity_files`
--

DROP TABLE IF EXISTS `marked_entity_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marked_entity_files` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) DEFAULT NULL,
  `file_location` varchar(1000) DEFAULT NULL,
  `marked_entity_id` int DEFAULT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `uploaded_by` int NOT NULL,
  `viewable_to` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marked_entity_files`
--

LOCK TABLES `marked_entity_files` WRITE;
/*!40000 ALTER TABLE `marked_entity_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `marked_entity_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `permission_id` int NOT NULL,
  `permission_type` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'read'),(2,'write'),(3,'edit'),(4,'delete'),(5,'upload'),(6,'download');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_options`
--

DROP TABLE IF EXISTS `poll_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poll_options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_options`
--

LOCK TABLES `poll_options` WRITE;
/*!40000 ALTER TABLE `poll_options` DISABLE KEYS */;
INSERT INTO `poll_options` VALUES (15,7,'sfs','2022-04-02 19:02:13'),(16,7,'sdfs','2022-04-02 19:02:13'),(17,8,'sfs','2022-04-02 19:10:03'),(18,8,'sdfs','2022-04-02 19:10:03'),(19,9,'1','2022-04-02 19:11:34'),(20,9,'dsfds','2022-04-02 19:11:34'),(21,9,'','2022-04-02 19:11:34'),(22,10,'1','2022-04-02 19:20:35'),(23,10,'dsfds','2022-04-02 19:20:35');
/*!40000 ALTER TABLE `poll_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_questions`
--

DROP TABLE IF EXISTS `poll_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poll_questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `poll_questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_questions`
--

LOCK TABLES `poll_questions` WRITE;
/*!40000 ALTER TABLE `poll_questions` DISABLE KEYS */;
INSERT INTO `poll_questions` VALUES (7,'dfsfds','2022-04-02 19:02:04',1),(8,'dfsfds','2022-04-02 19:09:21',1),(9,'sd','2022-04-02 19:11:31',1),(10,'sd','2022-04-02 19:14:38',1);
/*!40000 ALTER TABLE `poll_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_responses`
--

DROP TABLE IF EXISTS `poll_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poll_responses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  `option_id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `poll_responses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_responses`
--

LOCK TABLES `poll_responses` WRITE;
/*!40000 ALTER TABLE `poll_responses` DISABLE KEYS */;
INSERT INTO `poll_responses` VALUES (1,1,1,1,'2014-10-16 05:14:05'),(2,1,2,3,'2014-10-16 05:19:14'),(3,2,1,2,'2014-10-16 05:24:03'),(4,2,2,4,'2014-10-16 05:47:53');
/*!40000 ALTER TABLE `poll_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resources` (
  `resource_id` int NOT NULL AUTO_INCREMENT,
  `type` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_by` int NOT NULL,
  `created_at` date NOT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_at` date DEFAULT NULL,
  PRIMARY KEY (`resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'instructor'),(3,'teaching assistant'),(4,'student');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `section_id` int NOT NULL,
  `course_id` int NOT NULL,
  `prof_id` int NOT NULL,
  `section_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`section_id`),
  KEY `course_id_idx` (`course_id`),
  KEY `prof_id_idx` (`prof_id`),
  CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  CONSTRAINT `prof_id` FOREIGN KEY (`prof_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1,1,'AA'),(2,1,1,'BB'),(3,2,2,'CC');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ta_sections`
--

DROP TABLE IF EXISTS `ta_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ta_sections` (
  `ta_id` int NOT NULL,
  `section_id` int NOT NULL,
  PRIMARY KEY (`ta_id`,`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ta_sections`
--

LOCK TABLES `ta_sections` WRITE;
/*!40000 ALTER TABLE `ta_sections` DISABLE KEYS */;
INSERT INTO `ta_sections` VALUES (1,1),(2,3),(3,1),(3,2);
/*!40000 ALTER TABLE `ta_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id_idx` (`role_id`),
  CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,1),(1,2),(3,2),(1,3),(2,3),(3,3),(1,4),(2,4),(3,4),(4,4);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_at` date DEFAULT NULL,
  `isactive` tinyint DEFAULT NULL,
  `reset_password` tinyint NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'anne','123','anne@gmail.com','Anne','L','2022-03-25',1,0),(2,'priyanka','345','bajajp1994@gmail.com','Priyanka','Bajaj','2022-03-25',1,0),(3,'priya','123','bajajp@gmail.com','priya','bajaj','2022-03-25',1,0),(4,'priya1','123','bajajp1@gmail.com','priya1','bajaj1','2022-03-25',1,0),(16,'hhh','hhh','bajjp@gmail.com','hhhhh','jjjjj','2022-04-02',1,1),(17,'uuu','uuu','bajp@gmail.com','uuuuu','iiiii','2022-04-02',1,1),(18,'hhhkk','bnm','bhhp@gmail.com','rtym','fghj','2022-04-02',1,1),(19,'dfghj','hjnm','ghjp@gmail.com','fghgh','tyui','2022-04-02',1,1),(20,'fvgbnm','fgh','jajp@gmail.com','rtyu','fghh','2022-04-02',1,1),(21,'fghj','ghjnm','ghjpnm@gmail.com','vbnm','dfgh','2022-04-02',1,1),(22,'ghj','ghjk','gbhn@gmail.com','dfghjk','rtyui','2022-04-02',1,1),(23,'qwer','fgh','bnm@gmail.com','wert','fghyu','2022-04-02',1,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_resources_permissions`
--

DROP TABLE IF EXISTS `users_resources_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_resources_permissions` (
  `user_id` int NOT NULL,
  `resource_id` int NOT NULL,
  `permission_id` int NOT NULL,
  KEY `resource_id_idx` (`resource_id`),
  KEY `permission_id_idx` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_resources_permissions`
--

LOCK TABLES `users_resources_permissions` WRITE;
/*!40000 ALTER TABLE `users_resources_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_resources_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_sections`
--

DROP TABLE IF EXISTS `users_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_sections` (
  `user_id` int NOT NULL,
  `section_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`section_id`),
  KEY `section_fk` (`section_id`),
  CONSTRAINT `section_fk` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE,
  CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_sections`
--

LOCK TABLES `users_sections` WRITE;
/*!40000 ALTER TABLE `users_sections` DISABLE KEYS */;
INSERT INTO `users_sections` VALUES (1,1),(2,1),(3,1),(4,1),(1,2),(3,2),(1,3);
/*!40000 ALTER TABLE `users_sections` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-04  1:30:09
