-- MariaDB dump 10.18  Distrib 10.5.7-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: microblog
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
-- Current Database: `microblog`
--

/*!40000 DROP DATABASE IF EXISTS `microblog`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `microblog` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `microblog`;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` longtext DEFAULT NULL,
  `url-friendly` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (9,'Jeux mobile','Jeux disponibles sur smartphone','jeux-mobile'),(12,'Jeux consoles portable','Jeux disponible sur console portable','jeux-consoles-portable'),(14,'Jeux','Jeux PC ou Console','jeux'),(16,'Série','Séries TV','serie'),(17,'Film','Film','film'),(18,'Animé','Animation jap','anim');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(45) NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (28,'ios','IOS'),(29,'android','Android'),(30,'pc','PC'),(31,'mac','MAC'),(32,'ps3','PS3'),(33,'ps4','PS4'),(34,'wiiu','WiiU'),(50,'action','Action'),(51,'science-fiction','Science-fiction'),(52,'rpg','RPG'),(53,'mmorpg','MMORPG'),(54,'fps','FPS'),(55,'open-world','Open-world'),(56,'policier','Policier'),(57,'super-hero','Super-héro'),(58,'comics-manga','Comics: Manga'),(59,'adaptation','Adaptation'),(60,'mmo','MMO');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tickets_user_idx` (`user_id`),
  KEY `fk_tickets_category1_idx` (`category_id`),
  CONSTRAINT `fk_tickets_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tickets_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (61,'Yu-Gi-Oh! Duel Links : de nouvelles cartes disponibles... et les prochaines déjà en fuite !','&lt;p&gt;&lt;img style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; src=&quot;http://image.jeuxvideo.com/medias-md/148648/1486483991-8929-card.jpg&quot; alt=&quot;yugiho header&quot; width=&quot;559&quot; height=&quot;292&quot; /&gt;&lt;/p&gt;\r\n&lt;p class=&quot;intro-article&quot; data-jvcode=&quot;HTMLBLOCK&quot;&gt;&lt;a href=&quot;http://www.jeuxvideo.com/jeux/jeu-454945/&quot;&gt;Yu-Gi-Oh! Duel Links&lt;/a&gt;, le jeu mobile du moment, passionne les gamers du monde entier et &lt;a class=&quot;xXx &quot; href=&quot;http://www.jeuxvideo.com/informations/#100058&quot;&gt;Konami&lt;/a&gt; ne compte pas laisser l&#039;engouement s&#039;essoufler. Pour preuve : la sortie &amp;agrave; rythme soutenu de nouvelles cartes !&lt;/p&gt;\r\n&lt;p&gt;Apr&amp;egrave;s avoir &amp;eacute;t&amp;eacute; v&amp;eacute;ritablement &lt;a href=&quot;http://www.jeuxvideo.com/news/600375/victime-de-son-succes-yu-gi-oh-duel-links-suspend-ses-evenements-en-cours.htm&quot;&gt;victime du succ&amp;egrave;s&lt;/a&gt; de son free to play mobile, &lt;a class=&quot;xXx &quot; href=&quot;http://www.jeuxvideo.com/informations/#100058&quot;&gt;Konami&lt;/a&gt; passe &amp;agrave; l&#039;offensive en y apportant un peu plus de contenu. Depuis le 3 f&amp;eacute;vrier 2017, un &lt;strong&gt;nouveau mini-pack intitul&amp;eacute; &quot;Flame of the Tyrant&quot; dans lequel piocher ses boosters&lt;/strong&gt; est apparu dans la boutique, lequel comprend 40 cartes diff&amp;eacute;rentes dont &lt;a href=&quot;http://www.jeuxvideo.com/wikis-soluce-astuces/602879/cartes-ultra-rares-a-obtenir-dans-le-pack-flame-of-the-tyrant.htm&quot;&gt;2 Ultra-Rares&lt;/a&gt; et 8 UR. Lee 6 f&amp;eacute;vrier 2017, c&#039;&amp;eacute;tait &lt;strong&gt;au tour des duellistes l&amp;eacute;gendaires de proposer de nouvelles cartes &amp;agrave; d&amp;eacute;bloquer&lt;/strong&gt; en se frottant &amp;agrave; eux, dont le mythique &quot;Ga&amp;iuml;a le Dragon Champion&quot; de Yami Yugi.&lt;/p&gt;\r\n&lt;p&gt;Konami devrait poursuivre sur ce bon rythme :&lt;strong&gt; un &lt;a href=&quot;http://www.jeuxvideo.com/wikis-soluce-astuces/604390/bientot-un-5eme-pack-booster.htm&quot;&gt;nouveau (mini-)pack de cartes de type F&amp;eacute;e&lt;/a&gt; pourrait &amp;ecirc;tre accessible prochainement&lt;/strong&gt;, si l&#039;on en croit les leaks de donn&amp;eacute;es rep&amp;eacute;r&amp;eacute;s par les fans du jeu. A moyen terme, les joueurs devraient pouvoir &lt;a href=&quot;http://www.jeuxvideo.com/wikis-soluce-astuces/601815/personnages-a-venir.htm&quot;&gt;incarner d&#039;autres personnages du manga&lt;/a&gt; (Makuba Kaiba, Jaden Yuki, Yuma Tsukumo, ...) et&lt;strong&gt; collectionner les cartes &lt;a href=&quot;http://www.jeuxvideo.com/wikis-soluce-astuces/602354/bientot-l-arrivee-de-nouvelles-cartes.htm&quot;&gt;H&amp;eacute;ros El&amp;eacute;mentaire (Yu-Gi-Oh! GX), XYZ (Yu-Gi-Oh! ZEXAL) et Synchro (Yu-Gi-Oh! 5D&#039;s)&lt;/a&gt;&lt;/strong&gt;. &lt;a href=&quot;http://www.jeuxvideo.com/jeux/jeu-454945/&quot;&gt;Duel Links&lt;/a&gt; en garde visiblement encore beaucoup sous le pied pour rester dans les top des applications les plus jou&amp;eacute;es qu&#039;il n&#039;a pas quitt&amp;eacute; depuis son lancement en janvier !&lt;/p&gt;\r\n&lt;h4 id=&quot;tout-ce-qu-il-faut-savoir-sur-le-jeu-yu-gi-oh-duel-links&quot; class=&quot;h2-default-jv&quot;&gt;&lt;a href=&quot;http://www.jeuxvideo.com/wikis-soluce-astuces/454946/wiki-de-yu-gi-oh-duel-links.htm&quot;&gt;TOUT CE QU&#039;IL FAUT SAVOIR SUR LE JEU YU-GI-OH! DUEL LINKS !&lt;/a&gt;&lt;/h4&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;&lt;img src=&quot;http://image.jeuxvideo.com/medias-sm/148649/1486487502-3885-capture-d-ecran.png&quot; alt=&quot;&quot; width=&quot;200&quot; height=&quot;298&quot; /&gt;&lt;img src=&quot;http://image.jeuxvideo.com/medias-sm/148649/1486487502-6746-capture-d-ecran.jpg&quot; alt=&quot;&quot; width=&quot;204&quot; height=&quot;298&quot; /&gt;&lt;img src=&quot;http://image.jeuxvideo.com/medias-sm/148649/1486487502-3413-capture-d-ecran.png&quot; width=&quot;204&quot; height=&quot;296&quot; /&gt;&lt;/p&gt;\r\n&lt;h5 id=&quot;nos-conseils-pour-bien-debuter&quot; class=&quot;h3-default-jv&quot;&gt;&lt;a href=&quot;http://www.jeuxvideo.com/dossier/597416/yu-gi-oh-duel-links-decks-conseils-astuces-notre-guide-pour-bien-debuter/&quot;&gt;&amp;gt;&amp;gt;&amp;gt; Nos conseils pour bien d&amp;eacute;buter&lt;/a&gt;&lt;/h5&gt;\r\n&lt;h5 id=&quot;comment-debloquer-et-battre-les-duellistes-legendaires&quot; class=&quot;h3-default-jv&quot;&gt;&lt;a href=&quot;http://www.jeuxvideo.com/dossier/599391/yu-gi-oh-duel-links-comment-debloquer-et-battre-les-duellistes-legendaires-notre-guide-complet/&quot;&gt;&amp;gt;&amp;gt;&amp;gt; Comment d&amp;eacute;bloquer et battre les duellistes l&amp;eacute;gendaires&lt;/a&gt;&lt;/h5&gt;\r\n&lt;h5 id=&quot;l-evenement-bienvenue-dans-le-monde-des-toons&quot; class=&quot;h3-default-jv&quot;&gt;&lt;a href=&quot;http://www.jeuxvideo.com/news/600013/yu-gi-oh-duel-links-notre-guide-de-l-evenement-maximillion-pegasus.htm&quot;&gt;&amp;gt;&amp;gt;&amp;gt; L&#039;&amp;eacute;v&amp;eacute;nement &quot;Bienvenue dans le Monde des Toons&quot;&lt;/a&gt;&lt;/h5&gt;\r\n&lt;h5 id=&quot;les-meilleures-cartes-et-les-meilleurs-decks&quot; class=&quot;h3-default-jv&quot;&gt;&lt;a href=&quot;http://www.jeuxvideo.com/dossier/600548/yu-gi-oh-duel-links-meilleures-cartes-et-meilleurs-decks-notre-guide/&quot;&gt;&amp;gt;&amp;gt;&amp;gt; Les meilleures cartes et les meilleurs decks&lt;/a&gt;&lt;/h5&gt;','2017-02-07 21:25:00','yu-gi-oh-duel-links--de-nouvelles-cartes-disponibles-et-les-prochaines-deja-en-fuite-',1,9),(66,'Une petite équipe publie le fangame','&lt;p class=&quot;intro-article&quot; data-jvcode=&quot;HTMLBLOCK&quot;&gt;&lt;img style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; src=&quot;http://image.jeuxvideo.com/medias-md/148648/1486476200-5032-card.jpg&quot; width=&quot;433&quot; height=&quot;243&quot; /&gt;&lt;/p&gt;\r\n&lt;p class=&quot;intro-article&quot; data-jvcode=&quot;HTMLBLOCK&quot;&gt;Apr&amp;egrave;s huit ans de d&amp;eacute;veloppement, une petite &amp;eacute;quipe de d&amp;eacute;veloppeurs a mis au point un ambitieux fangame, d&amp;eacute;di&amp;eacute; &amp;agrave; l&#039;embl&amp;eacute;matique petit robot bleu. Appel&amp;eacute; Mega Man 2.5D, ce titre rend hommage &amp;agrave; la saga en int&amp;eacute;grant, comme son nom l&#039;indique, des m&amp;eacute;caniques li&amp;eacute;es &amp;agrave; la perspective, mais &amp;eacute;galement d&#039;autres nouveaut&amp;eacute;s.&lt;/p&gt;\r\n&lt;p&gt;Certains arpenteurs du net avaient d&amp;eacute;j&amp;agrave; connaissance de ce projet, et attendaient sa sortie ; en 2009, ses d&amp;eacute;veloppeurs travaillaient sur un premier prototype. Leur pari : cr&amp;eacute;er leur propre Mega Man, en y int&amp;eacute;grant des boss aper&amp;ccedil;us dans divers volets officiels de la saga. Shadow Man, Quick Man ou encore Tornado Man sont nos antagonistes dans ce jeu en 2.5D, qui propose en outre un mode coop&amp;eacute;ratif et des &lt;em&gt;cutscenes&lt;/em&gt; anim&amp;eacute;es.&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Disponible sur &lt;a href=&quot;http://www.jeuxvideo.com/pc.htm&quot;&gt;PC&lt;/a&gt;, le titre peut &amp;ecirc;tre promis &amp;agrave; un bel avenir... ou dispara&amp;icirc;tre, selon comment l&#039;ayant-droit de la licence, &lt;a class=&quot;xXx &quot; href=&quot;http://www.jeuxvideo.com/informations/#100167&quot;&gt;Capcom&lt;/a&gt;, r&amp;eacute;agit &amp;agrave; la nouvelle.&lt;/strong&gt;&lt;/p&gt;','2017-02-07 21:26:48','une-petite-equipe-publie-le-fangame-mega-man-25d',1,14),(67,'CS:GO : la map Dust 2 sort du mode compétitif','&lt;p class=&quot;intro-article&quot; style=&quot;text-align: justify;&quot; data-jvcode=&quot;HTMLBLOCK&quot;&gt;Une page se tourne dans l&#039;histoire de Counter Strike, &lt;a href=&quot;http://www.jeuxvideo.com/fps.htm&quot;&gt;FPS&lt;/a&gt; toujours extr&amp;ecirc;mement fr&amp;eacute;quent&amp;eacute; : les &amp;eacute;quipes d&#039;&lt;a class=&quot;xXx &quot; href=&quot;http://www.jeuxvideo.com/informations/#102730&quot;&gt;Hidden Path&lt;/a&gt; et &lt;a class=&quot;xXx &quot; href=&quot;http://www.jeuxvideo.com/informations/#100002&quot;&gt;Valve&lt;/a&gt; ont en effet d&amp;eacute;cid&amp;eacute; de retirer la map &quot;Dust 2&quot; de la playlist comp&amp;eacute;titive, et l&#039;ont remplac&amp;eacute;e par la tout aussi connue &quot;Inferno&quot;.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Si vous jouez ne serait-ce qu&#039;un peu &amp;agrave; CS:GO, vous avez rapidement remarqu&amp;eacute; la grande popularit&amp;eacute; de cette carte mythique, appr&amp;eacute;ci&amp;eacute;e par les snipers gr&amp;acirc;ce &amp;agrave; ses grands couloirs. Suite de la premi&amp;egrave;re &quot;Dust&quot; imagin&amp;eacute;e par David Johnston, Dust 2 est un embl&amp;egrave;me de Counter Strike, que les joueurs sollicitent un match sur deux. Elle vient d&#039;&amp;ecirc;tre &amp;eacute;vinc&amp;eacute;e de la comp&amp;eacute;tition.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Comme annonc&amp;eacute; par Valve par le biais du &lt;a class=&quot;xXx &quot; href=&quot;http://blog.counter-strike.net/index.php/2017/02/17863/&quot; target=&quot;_blank&quot; rel=&quot;nofollow noopener noreferrer&quot;&gt;blog de Counter Strike&lt;/a&gt;, &amp;agrave; l&#039;or&amp;eacute;e des prochains Intel Extreme Masters &amp;agrave; Katowice au mois de mars, la liste de lecture du mode comp&amp;eacute;titif re&amp;ccedil;oit un lifting. &lt;strong&gt;La map Dust 2 est en effet remplac&amp;eacute;e par Inferno ; ce qui devrait plut&amp;ocirc;t changer la donne, &amp;eacute;tant donn&amp;eacute; la configuration tr&amp;egrave;s diff&amp;eacute;rente de la carte italienne.&lt;/strong&gt; Les d&amp;eacute;veloppeurs n&#039;oublient pourtant pas la carte bien-aim&amp;eacute;e et lui d&amp;eacute;dient m&amp;ecirc;me un onglet &amp;agrave; part dans le menu du jeu... comme pour se faire pardonner par cette map iconique.&lt;/p&gt;\r\n&lt;figure class=&quot;serie-images&quot;&gt;\r\n&lt;p class=&quot;t-serie-images&quot; style=&quot;text-align: justify;&quot;&gt;Dust 2 ne fait d&amp;eacute;sormais plus partie du mode comp&amp;eacute;titif.&lt;/p&gt;\r\n&lt;div class=&quot;images&quot;&gt;&lt;a class=&quot;xXx capsule-img big-image&quot; href=&quot;http://www.jeuxvideo.com/screenshots/603908-2325123-0&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;&lt;img style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; title=&quot;CS:GO : la map Dust 2 sort du mode comp&amp;eacute;titif&quot; src=&quot;http://image.jeuxvideo.com/medias-md/148640/1486399433-5822-capture-d-ecran.jpg&quot; alt=&quot;CS:GO : la map Dust 2 sort du mode comp&amp;eacute;titif&quot; width=&quot;656&quot; height=&quot;634&quot; /&gt;&lt;/a&gt;&lt;/div&gt;\r\n&lt;/figure&gt;\r\n&lt;p&gt;&lt;strong&gt;Et vous, que pensez-vous de ce changement, vis-&amp;agrave;-vis des tournois et de vos propres parties ?&lt;/strong&gt;&lt;/p&gt;','2017-02-07 21:36:44','csgo--la-map-dust-2-sort-du-mode-competitif',1,14),(68,'J\'ai tapé ma tête contre le clavier','&lt;p&gt;dfhjhfjddhfj&lt;/p&gt;','2017-02-07 21:45:45','gdfhcjdfhj',5,12),(70,'Compte pour tester le back office. ','&lt;p&gt;login : visiteur&lt;/p&gt;\r\n&lt;p&gt;mot de passe : visiteur&lt;/p&gt;\r\n&lt;p&gt;Acc&amp;egrave;s limit&amp;eacute;, vous ne pouvez &amp;eacute;diter que les articles publi&amp;eacute;s par ce compte. Et vous ne pouvez que publier des articles. Vous n&#039;avez pas la possibilit&amp;eacute; d&#039;ajouter des tags ou des cat&amp;eacute;gories. :)&lt;/p&gt;','2017-02-07 22:13:35','compte-pour-tester-le-back-office',1,14),(73,'TEST P8','&lt;p&gt;Does it work ?&amp;nbsp;&lt;/p&gt;','2017-02-10 09:58:22','test-p8',12,9);
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets_has_tags`
--

DROP TABLE IF EXISTS `tickets_has_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets_has_tags` (
  `tickets_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL,
  PRIMARY KEY (`tickets_id`,`tags_id`),
  KEY `fk_tickets_has_tags_tags1_idx` (`tags_id`),
  KEY `fk_tickets_has_tags_tickets1_idx` (`tickets_id`),
  CONSTRAINT `fk_tickets_has_tags_tags1` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tickets_has_tags_tickets1` FOREIGN KEY (`tickets_id`) REFERENCES `tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets_has_tags`
--

LOCK TABLES `tickets_has_tags` WRITE;
/*!40000 ALTER TABLE `tickets_has_tags` DISABLE KEYS */;
INSERT INTO `tickets_has_tags` VALUES (61,28),(61,29),(66,30),(67,30),(67,31),(68,28),(68,29),(68,30),(68,31),(68,32),(68,33),(68,34),(70,28),(70,29),(70,30),(70,31),(70,32),(70,33),(70,34),(73,28),(73,29);
/*!40000 ALTER TABLE `tickets_has_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `permissions` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'crazyyoshi','$2y$10$.sf26tE3Cm.40MQiftpU4uhbCm5iHigkaGpU/aCnKd9HKJDDxLT6S','contact@maamar.fr','Miloud','Maamar',9),(5,'rand007','$2y$10$.sf26tE3Cm.40MQiftpU4uhbCm5iHigkaGpU/aCnKd9HKJDDxLT6S','rand.007@example.com','Nawak','Rodney',2),(6,'spdurif','$2y$10$.sf26tE3Cm.40MQiftpU4uhbCm5iHigkaGpU/aCnKd9HKJDDxLT6S','spdurif@mail.com','Sylvain Pierre','Durif',1),(7,'supra','$2y$10$.sf26tE3Cm.40MQiftpU4uhbCm5iHigkaGpU/aCnKd9HKJDDxLT6S','Supra@mail.com','Supra','Supra',0),(12,'visiteur','$2y$10$lkoliSOymoHXE1ufo0KqaOd.mXTCndkhBJ3LGITLmp/86xkzu1zQi','visiteur@mail.com','visiteur','visiteur',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
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
