-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: stashbridge
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.20.04.1

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
-- Table structure for table `connectors`
--

DROP TABLE IF EXISTS `connectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `connectors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `source` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `api` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `cred_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `cred_pass` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `type` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connectors`
--

LOCK TABLES `connectors` WRITE;
/*!40000 ALTER TABLE `connectors` DISABLE KEYS */;
/*!40000 ALTER TABLE `connectors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testing`
--

DROP TABLE IF EXISTS `testing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `source` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `api` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `cred_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `cred_pass` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `type` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `status` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `response` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testing`
--

LOCK TABLES `testing` WRITE;
/*!40000 ALTER TABLE `testing` DISABLE KEYS */;
/*!40000 ALTER TABLE `testing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `f_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `l_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `password` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `city` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `country` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `post_code` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `about` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'support@mygenghis.com','Admin','Graphene-BSM','c5f6f3327ee21a6ed276691d92dd9bdede33305fef049cf280c5a0e11c1f0a01','International House, 12 Constance Street','London','United Kingdom','E16 2DQ','Graphene-BSM LTD, stashBridge Support','2024-01-15 13:50:25','2024-01-16 12:11:52','2024-01-16 10:18:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'stashbridge'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-19 17:24:43
