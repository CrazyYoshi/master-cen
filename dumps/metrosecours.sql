-- MariaDB dump 10.18  Distrib 10.5.7-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: metrosecours
-- ------------------------------------------------------
-- Server version	10.5.7-MariaDB-1:10.5.7+maria~buster

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `metrosecours`
--

/*!40000 DROP DATABASE IF EXISTS `metrosecours`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `metrosecours` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `metrosecours`;

--
-- Table structure for table `badge`
--

DROP TABLE IF EXISTS `badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badge`
--

LOCK TABLES `badge` WRITE;
/*!40000 ALTER TABLE `badge` DISABLE KEYS */;
/*!40000 ALTER TABLE `badge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badge_has_utilisateur`
--

DROP TABLE IF EXISTS `badge_has_utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `badge_has_utilisateur` (
  `badge_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`badge_id`,`utilisateur_id`),
  KEY `fk_badge_has_utilisateur_utilisateur1_idx` (`utilisateur_id`),
  KEY `fk_badge_has_utilisateur_badge1_idx` (`badge_id`),
  CONSTRAINT `fk_badge_has_utilisateur_badge1` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_badge_has_utilisateur_utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badge_has_utilisateur`
--

LOCK TABLES `badge_has_utilisateur` WRITE;
/*!40000 ALTER TABLE `badge_has_utilisateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `badge_has_utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `line`
--

DROP TABLE IF EXISTS `line`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `path` varchar(255) NOT NULL,
  `color` varchar(45) NOT NULL,
  `transport_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`transport_type_id`,`path`),
  KEY `fk_line_transport_type_idx` (`transport_type_id`),
  CONSTRAINT `fk_line_transport_type` FOREIGN KEY (`transport_type_id`) REFERENCES `transport_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `line`
--

LOCK TABLES `line` WRITE;
/*!40000 ALTER TABLE `line` DISABLE KEYS */;
INSERT INTO `line` VALUES (1,'12','','#008250',1),(2,'13','','#00b9b9',1),(3,'4','','#be28aa',1),(4,'6','','#0ab46e',1);
/*!40000 ALTER TABLE `line` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `line_has_station`
--

DROP TABLE IF EXISTS `line_has_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `line_has_station` (
  `line_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  PRIMARY KEY (`line_id`,`station_id`),
  KEY `fk_line_has_station_station1_idx` (`station_id`),
  KEY `fk_line_has_station_line1_idx` (`line_id`),
  CONSTRAINT `fk_line_has_station_line1` FOREIGN KEY (`line_id`) REFERENCES `line` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_line_has_station_station1` FOREIGN KEY (`station_id`) REFERENCES `station` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `line_has_station`
--

LOCK TABLES `line_has_station` WRITE;
/*!40000 ALTER TABLE `line_has_station` DISABLE KEYS */;
INSERT INTO `line_has_station` VALUES (1,1),(1,3),(1,4),(2,1),(2,4),(2,7),(3,1),(3,5),(4,1),(4,2),(4,3),(4,5),(4,6);
/*!40000 ALTER TABLE `line_has_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem`
--

DROP TABLE IF EXISTS `problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `problem_type_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`problem_type_id`),
  KEY `fk_problem_problem_type1_idx` (`problem_type_id`),
  KEY `fk_problem_station1_idx` (`station_id`),
  KEY `fk_problem_line1_idx` (`line_id`),
  KEY `fk_problem_utilisateur1_idx` (`utilisateur_id`),
  CONSTRAINT `fk_problem_line1` FOREIGN KEY (`line_id`) REFERENCES `line` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_problem_problem_type1` FOREIGN KEY (`problem_type_id`) REFERENCES `problem_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_problem_station1` FOREIGN KEY (`station_id`) REFERENCES `station` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_problem_utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem`
--

LOCK TABLES `problem` WRITE;
/*!40000 ALTER TABLE `problem` DISABLE KEYS */;
INSERT INTO `problem` VALUES (1,'2018-01-11 00:00:00',1,4,2,1),(2,'2018-01-16 00:00:00',2,1,1,2),(3,'2018-01-22 23:02:46',1,1,2,1),(4,'2018-01-22 23:03:51',1,3,1,1),(5,'2018-01-22 23:04:01',2,4,2,1),(6,'2018-01-22 23:43:46',1,1,1,1),(7,'2018-01-22 23:44:11',2,1,1,1),(8,'2018-01-22 23:44:19',2,1,1,1),(9,'2018-01-22 23:44:21',2,1,1,1),(10,'2018-01-22 23:50:27',1,1,1,4),(11,'2018-01-22 23:52:45',3,1,3,4),(12,'2018-01-22 23:52:50',5,4,1,4),(13,'2018-01-22 23:53:01',6,5,3,4),(14,'2018-01-22 23:57:12',4,5,3,1),(15,'2018-01-22 23:57:38',5,1,3,1),(16,'2018-01-24 10:07:57',4,5,3,6);
/*!40000 ALTER TABLE `problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem_type`
--

DROP TABLE IF EXISTS `problem_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problem_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem_type`
--

LOCK TABLES `problem_type` WRITE;
/*!40000 ALTER TABLE `problem_type` DISABLE KEYS */;
INSERT INTO `problem_type` VALUES (1,'Retard','/img/icons/metro-retard.png'),(2,'Supprimé','/img/icons/metro-station-supprime.png'),(3,'Malaise voyageur',NULL),(4,'Colis suspect',NULL),(5,'Travaux',NULL),(6,'Station fermée',NULL);
/*!40000 ALTER TABLE `problem_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `latitude` int(11) DEFAULT NULL,
  `longitude` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station`
--

LOCK TABLES `station` WRITE;
/*!40000 ALTER TABLE `station` DISABLE KEYS */;
INSERT INTO `station` VALUES (1,'Montparnasse-Bienvenue',NULL,NULL),(2,'Edgar Quinet',NULL,NULL),(3,'Pasteur',NULL,NULL),(4,'Saint-Lazare',NULL,NULL),(5,'Raspail',NULL,NULL),(6,'Vavin',NULL,NULL),(7,'Duroc',NULL,NULL);
/*!40000 ALTER TABLE `station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transport_type`
--

DROP TABLE IF EXISTS `transport_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transport_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  `path` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transport_type`
--

LOCK TABLES `transport_type` WRITE;
/*!40000 ALTER TABLE `transport_type` DISABLE KEYS */;
INSERT INTO `transport_type` VALUES (1,'Métro','');
/*!40000 ALTER TABLE `transport_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `xp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'crazyyoshi','0615730508','mail@removed.com','$2y$10$R8KlMkhG8WsdVxu5XwSYruauWdSurE20y2/G4scC3qyHf858NzW22',NULL),(2,'charlies','0615730508','mail@removed.com','$2y$10$A9sybLyfp9Kg5YEwG0M8KOWz2zSEJGjMOGpDcz6N5N2nKaupxSOSi',NULL),(3,'charleston','0615705080','mail@removed.com','$2y$10$1GbCdaQ51.MzJU7LdaDi8OPuNTqzSIKkEF/NUsF44wQrKL0G2pFza',NULL),(4,'test','0615720508','mail@removed.com','$2y$10$/XzVzZCkxfX/pUQt14ciPeLU2D5X2QmqFNj/K9MqygAH.ZoSwMMLm',NULL),(5,'samueld','','mail@removed.com','$2y$10$pm/3Y6iOFMGfn9G.nqIB9.EhQlfBiFPQoxh6pf6S7pm7pL1cOIDBK',NULL),(6,'Kathrina','9787564534545','kath_mail@removed.com','$2y$10$gnGfGIjE4Mh3W0e8IO7wh.5s2eplkwQVBCSxlmMMfODb5XY4Jc.vq',NULL);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-17 21:16:16
