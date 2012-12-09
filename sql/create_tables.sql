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

/*Table structure for table `columns` */

DROP TABLE IF EXISTS `columns`;

CREATE TABLE `columns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sql` varchar(128) DEFAULT NULL,
  `isMandatory` tinyint(1) NOT NULL DEFAULT '0',
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `field` varchar(45) NOT NULL,
  `width` varchar(45) NOT NULL,
  `formatter` varchar(128) DEFAULT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  `style` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `threadId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdOn` datetime NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) DEFAULT NULL,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(6) DEFAULT NULL,
  `un_member` varchar(12) DEFAULT NULL,
  `calling_code` varchar(8) DEFAULT NULL,
  `cctld` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

/*Table structure for table `cups` */

DROP TABLE IF EXISTS `cups`;

CREATE TABLE `cups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `gameTypeId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL DEFAULT '-1',
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `gameinfoshogi` */

DROP TABLE IF EXISTS `gameinfoshogi`;

CREATE TABLE `gameinfoshogi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kifuId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

/*Table structure for table `gameresult` */

DROP TABLE IF EXISTS `gameresult`;

CREATE TABLE `gameresult` (
  `id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `path` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;

/*Table structure for table `gametype` */

DROP TABLE IF EXISTS `gametype`;

CREATE TABLE `gametype` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `kifu` */

DROP TABLE IF EXISTS `kifu`;

CREATE TABLE `kifu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `kifuText` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8;

/*Table structure for table `organizers` */

DROP TABLE IF EXISTS `organizers`;

CREATE TABLE `organizers` (
  `targetId` int(11) NOT NULL,
  `targetTableName` varchar(45) NOT NULL,
  `userId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `userId` int(11) NOT NULL,
  `tournamentId` int(11) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`userId`,`tournamentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `players` */

DROP TABLE IF EXISTS `players`;

CREATE TABLE `players` (
  `gameId` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL DEFAULT '0',
  `gameResultId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `resultscore` */

DROP TABLE IF EXISTS `resultscore`;

CREATE TABLE `resultscore` (
  `tournamentId` int(11) NOT NULL,
  `gameresultId` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `thread` */

DROP TABLE IF EXISTS `thread`;

CREATE TABLE `thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8;

/*Table structure for table `timezones` */

DROP TABLE IF EXISTS `timezones`;

CREATE TABLE `timezones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timezone_location` varchar(30) NOT NULL DEFAULT '',
  `gmt` varchar(11) NOT NULL DEFAULT '',
  `offset` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

/*Table structure for table `tournament_columns` */

DROP TABLE IF EXISTS `tournament_columns`;

CREATE TABLE `tournament_columns` (
  `tournamentId` int(11) NOT NULL,
  `columnId` int(11) NOT NULL,
  UNIQUE KEY `unique_attrs` (`tournamentId`,`columnId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tournaments` */

DROP TABLE IF EXISTS `tournaments`;

CREATE TABLE `tournaments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tournamentTypeId` int(11) NOT NULL,
  `cupId` int(11) NOT NULL,
  `gameTypeId` decimal(10,0) NOT NULL,
  `createdBy` int(11) NOT NULL DEFAULT '-1',
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_attrs` (`name`,`cupId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Table structure for table `tournamenttype` */

DROP TABLE IF EXISTS `tournamenttype`;

CREATE TABLE `tournamenttype` (
  `id` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `userinfo` */

DROP TABLE IF EXISTS `userinfo`;

CREATE TABLE `userinfo` (
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email_address` varchar(128) NOT NULL,
  `roleId` int(11) NOT NULL DEFAULT '2',
  `createdOn` datetime NOT NULL,
  `modifiedOn` datetime NOT NULL,
  `nationalityId` int(11) NOT NULL DEFAULT '-1',
  `timezoneId` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

/*!50001 DROP VIEW IF EXISTS `user_role` */;
/*!50001 DROP TABLE IF EXISTS `user_role` */;

/*!50001 CREATE TABLE  `user_role`(
 `id` int(11) ,
 `first_name` varchar(45) ,
 `middle_name` varchar(45) ,
 `last_name` varchar(45) ,
 `username` varchar(45) ,
 `password` varchar(32) ,
 `email_address` varchar(128) ,
 `roleId` int(11) ,
 `role` varchar(45) ,
 `createdOn` datetime ,
 `modifiedOn` datetime 
)*/;

/*View structure for view user_role */

/*!50001 DROP TABLE IF EXISTS `user_role` */;
/*!50001 DROP VIEW IF EXISTS `user_role` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_role` AS (select `u`.`id` AS `id`,`u`.`first_name` AS `first_name`,`u`.`middle_name` AS `middle_name`,`u`.`last_name` AS `last_name`,`u`.`username` AS `username`,`u`.`password` AS `password`,`u`.`email_address` AS `email_address`,`u`.`roleId` AS `roleId`,`r`.`name` AS `role`,`u`.`createdOn` AS `createdOn`,`u`.`modifiedOn` AS `modifiedOn` from (`users` `u` join `role` `r`) where (`u`.`roleId` = `r`.`id`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
