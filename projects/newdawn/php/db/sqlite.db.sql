BEGIN TRANSACTION;
CREATE TABLE "thetrail" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`diploma`	TEXT NOT NULL,
	`year`	TEXT NOT NULL,
	`entity`	TEXT NOT NULL,
	`entity_address`	TEXT,
	`img`	TEXT
);
INSERT INTO `thetrail` VALUES (1,'Bac STI2D Système d''information et numérique, Mention assez-bien','2013','Lycée Emilie de Breteuil','https://www.google.fr/maps/place/Lyc%C3%A9e+Polyvalent+Emilie+de+Breteuil/@48.7816197,2.0403865,16.75z/data=!4m5!3m4!1s0x47e686d35631b707:0xb1a5528d59b0155c!8m2!3d48.7816142!4d2.0418329',NULL);
INSERT INTO `thetrail` VALUES (2,'DUT Métiers du Multimédia et de l''Internet (sur 2 ans)','2015','IUT de Vélizy-Villacoublay','https://www.google.fr/maps/place/IUT+de+V%C3%A9lizy-Villacoublay/@48.7817156,2.2155039,17z/data=!3m1!4b1!4m5!3m4!1s0x47e67bd6e0de7851:0xbabe984ad233bd22!8m2!3d48.7817156!4d2.2176926',NULL);
INSERT INTO `thetrail` VALUES (3,'Licence Pro Création Développement Numérique en Ligne (CDNL), Mention bien','2016','Université Paris 8','https://www.google.fr/maps/place/Universit%C3%A9+Paris+8/@48.9449361,2.3613735,17z/data=!3m1!4b1!4m5!3m4!1s0x47e6695017810e3d:0x95196baf9263e53a!8m2!3d48.9449361!4d2.3635622',NULL);
INSERT INTO `thetrail` VALUES (4,'M1 Humanité Numérique Mention Création Edition Numérique (CEN)','2017','Université Paris 8','https://www.google.fr/maps/place/Universit%C3%A9+Paris+8/@48.9449361,2.3613735,17z/data=!3m1!4b1!4m5!3m4!1s0x47e6695017810e3d:0x95196baf9263e53a!8m2!3d48.9449361!4d2.3635622',NULL);
CREATE TABLE "skill_category" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	TEXT NOT NULL
);
INSERT INTO `skill_category` VALUES (2,'Technologie de développement');
INSERT INTO `skill_category` VALUES (3,'Graphisme - Pao - Modélisation');
INSERT INTO `skill_category` VALUES (4,'Audio-visuel');
INSERT INTO `skill_category` VALUES (5,'Environnements');
CREATE TABLE "skill" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	TEXT NOT NULL,
	`img`	TEXT NOT NULL,
	`category_id`	INTEGER NOT NULL
);
INSERT INTO `skill` VALUES (1,'HTML5','/assets/img/skills/html5.jpg',2);
INSERT INTO `skill` VALUES (2,'CSS3','/assets/img/skills/css3.jpg',2);
INSERT INTO `skill` VALUES (3,'Javascript','/assets/img/skills/js.jpg',2);
INSERT INTO `skill` VALUES (4,'jQuery','/assets/img/skills/jquery.jpg',2);
INSERT INTO `skill` VALUES (5,'PHP','/assets/img/skills/php.jpg',2);
INSERT INTO `skill` VALUES (6,'MySQL','/assets/img/skills/mysql.png',2);
INSERT INTO `skill` VALUES (7,'SQlite','/assets/img/skills/sqlite.png',2);
INSERT INTO `skill` VALUES (8,'Git','/assets/img/skills/git.jpg',5);
INSERT INTO `skill` VALUES (9,'SASS','/assets/img/skills/sass.png',2);
INSERT INTO `skill` VALUES (10,'Gulp','/assets/img/skills/gulp.png',2);
INSERT INTO `skill` VALUES (11,'AngularJS','/assets/img/skills/angularjs.png',2);
INSERT INTO `skill` VALUES (12,'Cordova','/assets/img/skills/cordova.jpg',2);
INSERT INTO `skill` VALUES (13,'Ionic','/assets/img/skills/ionic.png',2);
INSERT INTO `skill` VALUES (14,'BootStrap','/assets/img/skills/bootstrap.png',2);
INSERT INTO `skill` VALUES (15,'Unity','/assets/img/skills/unity.png',2);
INSERT INTO `skill` VALUES (16,'C#','/assets/img/skills/c-sharp.png',2);
INSERT INTO `skill` VALUES (17,'PandaSuite','/assets/img/skills/pandasuite.png',2);
INSERT INTO `skill` VALUES (18,'Processing','/assets/img/skills/processing.jpg',2);
INSERT INTO `skill` VALUES (19,'PureData','/assets/img/skills/puredata.jpg',2);
INSERT INTO `skill` VALUES (20,'Photoshop','/assets/img/skills/photoshop.jpg',3);
INSERT INTO `skill` VALUES (21,'InDesign','/assets/img/skills/indesign.jpg',3);
INSERT INTO `skill` VALUES (22,'Flash Pro','/assets/img/skills/flashpro.jpg',3);
INSERT INTO `skill` VALUES (23,'Illustrator','/assets/img/skills/illustrator.jpg',3);
INSERT INTO `skill` VALUES (24,'Final Cut Pro X','/assets/img/skills/fcpx.jpg',4);
INSERT INTO `skill` VALUES (25,'After Effect','/assets/img/skills/aftereffect.jpg',4);
INSERT INTO `skill` VALUES (26,'Blender','/assets/img/skills/blender.png',3);
INSERT INTO `skill` VALUES (27,'Apache','/assets/img/skills/apache.png',5);
INSERT INTO `skill` VALUES (28,'Debian','/assets/img/skills/debian.png',5);
INSERT INTO `skill` VALUES (29,'MacOS','/assets/img/skills/macos.png',5);
INSERT INTO `skill` VALUES (30,'Windows ','/assets/img/skills/windows.png',5);
CREATE TABLE "personal_info" (
	`name`	TEXT NOT NULL,
	`surname`	TEXT NOT NULL,
	`address`	TEXT NOT NULL,
	`zipcode`	TEXT NOT NULL,
	`town`	TEXT NOT NULL,
	`phone`	TEXT NOT NULL,
	`logo`	TEXT,
	`email`	TEXT
);
INSERT INTO `personal_info` VALUES ('Miloud','Maamar','4 Rue Louis Aragon','78190','Trappes','615730508','/assets/img/logo.svg','contact@maamar.fr');
CREATE TABLE `leisure` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`name`	TEXT NOT NULL,
	`img`	TEXT,
	`text`	TEXT NOT NULL
);
INSERT INTO `leisure` VALUES (2,'Passionné du Web',NULL,'Diplomé d''un DUT Métiers du Multimédia et de l''Internet.
');
INSERT INTO `leisure` VALUES (3,'Passionné par le Japon',NULL,'Je suis particulièrement interessé par ses paysages, ses monuments historiques, sa culture. Les nombreux temples de Kyoto, et l''architecture traditionnelle des habitations.');
INSERT INTO `leisure` VALUES (4,'Games',NULL,'');
INSERT INTO `leisure` VALUES (5,'Music',NULL,'');
CREATE TABLE "experience" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`title`	TEXT NOT NULL,
	`period`	TEXT NOT NULL,
	`text`	TEXT NOT NULL,
	`job`	TEXT NOT NULL,
	`img`	TEXT NOT NULL,
	`bgcolor`	TEXT,
	`where`	TEXT,
	`color`	TEXT
);
INSERT INTO `experience` VALUES (1,'Laboratoire d''Ingénierie des Systèmes de Versailes','13 avril 2015 - 24 juillet 2015','Conception et développement d''un prototype d''aide et d''assistance à l''apprentissage d''une aide à la mobilité.','Graphiste, Développeur','https://www.maamar.fr/assets/works/lisv.svg','#fefefe','LISV','black');
INSERT INTO `experience` VALUES (2,'AnID','Janvier 2014 - Avril 2015','Infographies, supports de communication, Identité visuelle / Travail de géolocalisation avec les Api Google Maps et Places','Développeur Web et Mobile','https://www.maamar.fr/assets/works/anid.svg','#9460a4','AnID','white');
INSERT INTO `experience` VALUES (3,'TVFIL78','16 Juin 2014 - 16 Juillet 2014','Gestion communauté Twitter, Facebook, Google Plus; Edition et envoi de la newsletter; Gestion de contenu CMS Wordpress; Developpement d''une nouvelle newsletter','Assistant webmaster, Community manager','https://www.maamar.fr/assets/works/tvfil78.svg','#fefefe','TVFIL78','black');
COMMIT;
