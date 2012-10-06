/*
SQLyog Community v10.12 
MySQL - 5.5.16 : Database - sgma
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sgma` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sgma`;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `threadId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdOn` datetime NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/*Data for the table `comments` */

insert  into `comments`(`id`,`threadId`,`createdBy`,`createdOn`,`comment`) values (1,3,4,'2012-08-21 23:56:19','comment'),(2,13,0,'2012-08-26 15:05:53','5'),(3,13,0,'2012-08-26 15:06:40','d'),(4,18,0,'2012-08-26 15:08:08','ddss'),(5,18,0,'2012-08-26 15:09:02','d'),(6,13,0,'2012-08-26 15:11:26','q'),(7,15,0,'2012-08-26 15:13:58','3'),(8,18,0,'2012-08-26 15:19:04','s'),(9,18,0,'2012-08-26 15:19:50','nothing'),(10,18,0,'2012-08-26 15:19:55','wow'),(11,18,0,'2012-08-26 15:22:48','d'),(12,13,0,'2012-08-26 15:23:13','ds'),(13,13,0,'2012-08-26 15:23:16','fdsafds'),(14,15,0,'2012-08-26 17:54:34','fdsa'),(15,13,0,'2012-08-29 15:30:17','nice\nfeature'),(16,13,0,'2012-08-29 15:30:43','new line can be\ninserted? here\nor not'),(17,18,0,'2012-09-12 22:32:38','fdsa'),(18,21,0,'2012-09-21 14:28:06','mison bar\n'),(19,22,0,'2012-09-21 14:28:13','こんにちは\n'),(20,23,0,'2012-09-21 14:28:23','よろしくお願いします！'),(21,16,0,'2012-09-21 14:39:17','こら\n'),(22,16,0,'2012-09-21 14:39:21','なす'),(23,16,0,'2012-09-21 14:39:27','tamago-n'),(24,13,0,'2012-09-21 14:41:23','こんいちは\n'),(25,23,0,'2012-09-21 14:43:59','がんばれ'),(26,17,0,'2012-09-21 14:44:39','nishinikon'),(27,23,0,'2012-09-21 15:45:44','毎日がeverydayやで\n'),(28,16,0,'2012-09-21 16:35:38','ds'),(29,16,0,'2012-09-21 16:36:19','ds'),(30,16,0,'2012-09-21 16:36:21','ds'),(31,16,0,'2012-09-21 16:36:25','fdsaf\n'),(32,16,0,'2012-09-21 16:36:25','fdsaf\n'),(33,20,0,'2012-09-21 16:38:22','fdsafd'),(34,20,0,'2012-09-21 16:39:15','g'),(35,23,0,'2012-09-21 16:41:12','gfds'),(36,18,0,'2012-09-21 16:41:43','d'),(37,20,0,'2012-09-21 16:43:34','ggg'),(38,17,0,'2012-09-21 16:47:10','fdsafdsa'),(39,17,0,'2012-09-21 16:47:16','fdsafdsafdsafdsafdsfdsafdsafdsafdsafdsafdsafdsafdsa'),(40,23,0,'2012-09-21 17:17:15','I changed the date of the game\r\n	    from  2012-08-09 20:03:39 to 2012-08-30 20:03:00.\r\n	    '),(41,23,0,'2012-09-21 17:22:36','I changed the date of the game\r\n	    from  2012-08-09 20:03:39 to 2012-08-09 21:00:00.\r\n	    '),(42,23,0,'2012-09-21 17:23:38','I changed the date of the game\r\n	    from  2012-08-09 20:03:39 to 2012-08-09 21:00:00.\r\n	    '),(43,23,0,'2012-09-21 17:33:56','I changed the date of the game\r\n	    from  2012-08-09 20:03:39 to 2012-08-09 21:15:00.\r\n	    '),(44,23,0,'2012-09-24 16:22:28','ds'),(45,23,0,'2012-09-24 16:22:45','fdsafdsafdsafdsa'),(46,23,0,'2012-09-24 16:23:08','楽しい懇親会！'),(47,16,0,'2012-09-24 16:29:17','ｆｄｓ'),(48,16,0,'2012-09-24 16:29:25','こんにちは'),(49,17,0,'2012-09-30 21:52:49','いつ対戦？');

/*Table structure for table `cups` */

DROP TABLE IF EXISTS `cups`;

CREATE TABLE `cups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `createdBy` int(11) DEFAULT '-1',
  `createdOn` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `cups` */

insert  into `cups`(`id`,`name`,`createdBy`,`createdOn`) values (1,'Ginsho Cup',1,'2012-07-01 15:22:01'),(2,'81 dojo 6th Cup',1,'2012-07-10 16:28:30'),(3,'makoto cup',0,'2012-09-08 04:05:32'),(4,'Europe Shogi 5th Convension',0,'2012-09-24 09:06:52');

/*Table structure for table `gameinfoshogi` */

DROP TABLE IF EXISTS `gameinfoshogi`;

CREATE TABLE `gameinfoshogi` (
  `gameId` int(11) NOT NULL,
  `gameTypeId` int(11) NOT NULL,
  `kifuId` int(11) DEFAULT NULL,
  PRIMARY KEY (`gameId`),
  CONSTRAINT `gameID` FOREIGN KEY (`gameId`) REFERENCES `games` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gameinfoshogi` */

/*Table structure for table `gameresult` */

DROP TABLE IF EXISTS `gameresult`;

CREATE TABLE `gameresult` (
  `id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gameresult` */

insert  into `gameresult`(`id`,`description`) values (-1,'Not Yet Played'),(0,'Won'),(1,'Lost'),(2,'Draw'),(3,'Default Win');

/*Table structure for table `games` */

DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `tournamentId` int(11) NOT NULL,
  `gameTypeId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `threadId` int(11) NOT NULL,
  `gameInfoId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `games` */

insert  into `games`(`id`,`name`,`tournamentId`,`gameTypeId`,`date`,`threadId`,`gameInfoId`) values (1,'',1,0,'2012-07-31 16:28:46',17,1),(2,'',1,0,'2012-08-01 16:30:13',13,2),(3,'',1,0,'2012-08-01 16:30:13',20,3),(4,'',1,0,'2012-08-01 16:30:13',16,4),(5,'',1,0,'2012-08-02 16:30:13',15,5),(6,'',1,0,'0000-00-00 00:00:00',18,-1),(7,'',2,0,'2012-08-09 21:15:00',23,0);

/*Table structure for table `gametype` */

DROP TABLE IF EXISTS `gametype`;

CREATE TABLE `gametype` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gametype` */

insert  into `gametype`(`id`,`name`) values (0,'Shogi'),(1,'Badminton');

/*Table structure for table `kifu` */

DROP TABLE IF EXISTS `kifu`;

CREATE TABLE `kifu` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `savedUrl` text,
  `kifuText` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `kifu` */

/*Table structure for table `organizers` */

DROP TABLE IF EXISTS `organizers`;

CREATE TABLE `organizers` (
  `targetId` int(11) NOT NULL,
  `targetTableName` varchar(45) NOT NULL,
  `userId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `organizers` */

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `userId` int(11) NOT NULL,
  `tournamentId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`tournamentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participants` */

insert  into `participants`(`userId`,`tournamentId`) values (0,1),(0,2),(1,1),(9,1),(9,2),(10,1);

/*Table structure for table `players` */

DROP TABLE IF EXISTS `players`;

CREATE TABLE `players` (
  `gameId` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL DEFAULT '0',
  `gameResultId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `players` */

insert  into `players`(`gameId`,`userId`,`gameResultId`) values (1,0,0),(1,1,1),(2,9,1),(2,0,0),(3,0,-1),(3,10,-1),(4,1,-1),(4,9,-1),(5,1,1),(5,10,1),(6,9,1),(6,10,3),(7,0,0),(7,9,1);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`id`,`name`) values (0,'System'),(1,'Admin'),(2,'Normal');

/*Table structure for table `thread` */

DROP TABLE IF EXISTS `thread`;

CREATE TABLE `thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `thread` */

insert  into `thread`(`id`,`name`,`createdBy`,`createdOn`) values (6,'',0,'2012-08-26 12:38:17'),(7,'',0,'2012-08-26 12:46:20'),(8,'',0,'2012-08-26 12:59:09'),(9,'',0,'2012-08-26 13:00:28'),(10,'',0,'2012-08-26 13:00:34'),(11,'',0,'2012-08-26 13:00:40'),(12,'',0,'2012-08-26 13:01:47'),(13,'',0,'2012-08-26 13:02:35'),(14,'',0,'2012-08-26 14:08:53'),(15,'',0,'2012-08-26 14:09:44'),(16,'',0,'2012-08-26 14:10:19'),(17,'',0,'2012-08-26 14:11:05'),(18,'',0,'2012-08-26 14:11:39'),(19,'',0,'2012-08-26 14:21:09'),(20,'',0,'2012-08-26 14:57:58'),(21,'',0,'2012-09-21 14:28:06'),(22,'',0,'2012-09-21 14:28:13'),(23,'',0,'2012-09-21 14:28:23');

/*Table structure for table `tournaments` */

DROP TABLE IF EXISTS `tournaments`;

CREATE TABLE `tournaments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `tournamentTypeId` int(11) DEFAULT NULL,
  `cupId` int(11) DEFAULT NULL,
  `createdBy` int(11) NOT NULL DEFAULT '-1',
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tournaments` */

insert  into `tournaments`(`id`,`name`,`tournamentTypeId`,`cupId`,`createdBy`,`createdOn`) values (1,'A block',1,2,-1,'0000-00-00 00:00:00'),(2,'B block Knock-down tournament',1,2,-1,'0000-00-00 00:00:00'),(3,'Tournament Name',0,1,0,'0000-00-00 00:00:00'),(4,'mako',0,1,0,'0000-00-00 00:00:00'),(5,'sachi',0,1,0,'2012-09-08 03:50:24'),(6,'ishikawa',1,1,0,'2012-09-08 10:57:06'),(7,'no cup determined',0,-1,0,'2012-09-08 03:59:58'),(8,'cup determined',1,1,0,'2012-09-08 04:00:09'),(9,'Tournament Name',1,4,0,'2012-09-24 09:07:00');

/*Table structure for table `tournamenttype` */

DROP TABLE IF EXISTS `tournamenttype`;

CREATE TABLE `tournamenttype` (
  `id` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tournamenttype` */

insert  into `tournamenttype`(`id`,`name`) values (0,'Knock-out'),(1,'Group');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email_address` varchar(128) NOT NULL DEFAULT '-1',
  `roleId` int(11) NOT NULL DEFAULT '2',
  `createdOn` datetime NOT NULL,
  `modifiedOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`username`,`password`,`email_address`,`roleId`,`createdOn`,`modifiedOn`) values (0,'kunio','yonenaga','kunio','kunio','kunio@ginsho.jp',2,'2012-08-16 21:46:40','2012-08-16 21:46:40'),(1,'yoshiharu','habu','habu','habu','habu@ginsho.jp',2,'2012-07-10 12:02:57','2012-07-10 12:02:57'),(2,'toshiyuki','moriuchi','moriuchi','moriuchi','yeele@ginsho.jp',2,'2012-07-10 12:02:57','2012-07-10 12:02:57'),(9,'kazuki','kimura','kimura','kimura','kimura@ginsho.jp',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'tokyo','tokyo','tokyo','tokyo','tokyo@tokyo',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'madoka','kitao','madoka','madoka','madoka@ginsho.jp',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'admin','admin','admin','admin','admin@ginsho.jp',0,'2012-08-16 21:46:40','2012-08-16 21:46:40');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
