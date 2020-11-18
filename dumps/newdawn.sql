-- MariaDB dump 10.18  Distrib 10.5.7-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: newdawn
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
-- Current Database: `newdawn`
--

/*!40000 DROP DATABASE IF EXISTS `newdawn`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `newdawn` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `newdawn`;

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `period` text NOT NULL,
  `text` text NOT NULL,
  `job` text NOT NULL,
  `img` text NOT NULL,
  `bgcolor` text DEFAULT NULL,
  `where` text DEFAULT NULL,
  `color` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experience`
--

LOCK TABLES `experience` WRITE;
/*!40000 ALTER TABLE `experience` DISABLE KEYS */;
INSERT INTO `experience` VALUES (1,'Laboratoire d\'Ingénierie des Systèmes de Versailes','13 avril 2015 - 24 juillet 2015','Conception et développement d\'un prototype d\'aide et d\'assistance à l\'apprentissage d\'une aide à la mobilité.','Graphiste, Développeur','/assets/img/lisv.svg','#fefefe','LISV','black'),(2,'AnID','Janvier 2014 - Avril 2015','Infographies, supports de communication, Identité visuelle / Travail de géolocalisation avec les Api Google Maps et Places','Développeur Web et Mobile','/assets/img/anid.svg','#9460a4','AnID','white'),(3,'TVFIL78','16 Juin 2014 - 16 Juillet 2014','Gestion communauté Twitter, Facebook, Google Plus; Edition et envoi de la newsletter; Gestion de contenu CMS Wordpress; Developpement d\'une nouvelle newsletter','Assistant webmaster, Community manager','/assets/img/tvfil78.svg','#fefefe','TVFIL78','black');
/*!40000 ALTER TABLE `experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leisure`
--

DROP TABLE IF EXISTS `leisure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leisure` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `img` text DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leisure`
--

LOCK TABLES `leisure` WRITE;
/*!40000 ALTER TABLE `leisure` DISABLE KEYS */;
INSERT INTO `leisure` VALUES (2,'Passionné du Web',NULL,'Diplomé d\'un DUT Métiers du Multimédia et de l\'Internet.\r\n'),(3,'Passionné par le Japon',NULL,'Je suis particulièrement interessé par ses paysages, ses monuments historiques, sa culture. Les nombreux temples de Kyoto, et l\'architecture traditionnelle des habitations.'),(4,'Games',NULL,''),(5,'Music',NULL,'');
/*!40000 ALTER TABLE `leisure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_info`
--

DROP TABLE IF EXISTS `personal_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_info` (
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `address` text NOT NULL,
  `zipcode` text NOT NULL,
  `town` text NOT NULL,
  `phone` text NOT NULL,
  `logo` text DEFAULT NULL,
  `email` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_info`
--

LOCK TABLES `personal_info` WRITE;
/*!40000 ALTER TABLE `personal_info` DISABLE KEYS */;
INSERT INTO `personal_info` VALUES ('Miloud','Maamar','4 Rue Louis Aragon','78190','Trappes','615730508','/assets/img/logo.svg','mail@removed.com');
/*!40000 ALTER TABLE `personal_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (1,'HTML5','/assets/img/skills/html5.jpg',2),(2,'CSS3','/assets/img/skills/css3.jpg',2),(3,'Javascript','/assets/img/skills/js.jpg',2),(4,'jQuery','/assets/img/skills/jquery.jpg',2),(5,'PHP','/assets/img/skills/php.jpg',2),(6,'MySQL','/assets/img/skills/mysql.png',2),(7,'SQlite','/assets/img/skills/sqlite.png',2),(8,'Git','/assets/img/skills/git.jpg',5),(9,'SASS','/assets/img/skills/sass.png',2),(10,'Gulp','/assets/img/skills/gulp.png',2),(11,'AngularJS','/assets/img/skills/angularjs.png',2),(12,'Cordova','/assets/img/skills/cordova.jpg',2),(13,'Ionic','/assets/img/skills/ionic.png',2),(14,'BootStrap','/assets/img/skills/bootstrap.png',2),(15,'Unity','/assets/img/skills/unity.png',2),(16,'C#','/assets/img/skills/c-sharp.png',2),(17,'PandaSuite','/assets/img/skills/pandasuite.png',2),(18,'Processing','/assets/img/skills/processing.jpg',2),(19,'PureData','/assets/img/skills/puredata.jpg',2),(20,'Photoshop','/assets/img/skills/photoshop.jpg',3),(21,'InDesign','/assets/img/skills/indesign.jpg',3),(22,'Flash Pro','/assets/img/skills/flashpro.jpg',3),(23,'Illustrator','/assets/img/skills/illustrator.jpg',3),(24,'Final Cut Pro X','/assets/img/skills/fcpx.jpg',4),(25,'After Effect','/assets/img/skills/aftereffect.jpg',4),(26,'Blender','/assets/img/skills/blender.png',3),(27,'Apache','/assets/img/skills/apache.png',5),(28,'Debian','/assets/img/skills/debian.png',5),(29,'MacOS','/assets/img/skills/macos.png',5),(30,'Windows ','/assets/img/skills/windows.png',5);
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_category`
--

DROP TABLE IF EXISTS `skill_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_category`
--

LOCK TABLES `skill_category` WRITE;
/*!40000 ALTER TABLE `skill_category` DISABLE KEYS */;
INSERT INTO `skill_category` VALUES (2,'Technologie de développement'),(3,'Graphisme - Pao - Modélisation'),(4,'Audio-visuel'),(5,'Environnements');
/*!40000 ALTER TABLE `skill_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thetrail`
--

DROP TABLE IF EXISTS `thetrail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thetrail` (
  `id` int(11) NOT NULL,
  `diploma` text NOT NULL,
  `year` text NOT NULL,
  `entity` text NOT NULL,
  `entity_address` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thetrail`
--

LOCK TABLES `thetrail` WRITE;
/*!40000 ALTER TABLE `thetrail` DISABLE KEYS */;
INSERT INTO `thetrail` VALUES (1,'Bac STI2D Système d\'information et numérique, Mention assez-bien','2013','Lycée Emilie de Breteuil','https://www.google.fr/maps/place/Lyc%C3%A9e+Polyvalent+Emilie+de+Breteuil/@48.7816197,2.0403865,16.75z/data=!4m5!3m4!1s0x47e686d35631b707:0xb1a5528d59b0155c!8m2!3d48.7816142!4d2.0418329',NULL),(2,'DUT Métiers du Multimédia et de l\'Internet (sur 2 ans)','2015','IUT de Vélizy-Villacoublay','https://www.google.fr/maps/place/IUT+de+V%C3%A9lizy-Villacoublay/@48.7817156,2.2155039,17z/data=!3m1!4b1!4m5!3m4!1s0x47e67bd6e0de7851:0xbabe984ad233bd22!8m2!3d48.7817156!4d2.2176926',NULL),(3,'Licence Pro Création Développement Numérique en Ligne (CDNL), Mention bien','2016','Université Paris 8','https://www.google.fr/maps/place/Universit%C3%A9+Paris+8/@48.9449361,2.3613735,17z/data=!3m1!4b1!4m5!3m4!1s0x47e6695017810e3d:0x95196baf9263e53a!8m2!3d48.9449361!4d2.3635622',NULL),(4,'M1 Humanité Numérique Mention Création Edition Numérique (CEN)','2017','Université Paris 8','https://www.google.fr/maps/place/Universit%C3%A9+Paris+8/@48.9449361,2.3613735,17z/data=!3m1!4b1!4m5!3m4!1s0x47e6695017810e3d:0x95196baf9263e53a!8m2!3d48.9449361!4d2.3635622',NULL);
/*!40000 ALTER TABLE `thetrail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-16 20:05:48
