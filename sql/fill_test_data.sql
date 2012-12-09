/*
SQLyog Community v10.12 
MySQL - 5.5.16 : Database - otma
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Data for the table `cups` */

insert  into `cups`(`id`,`name`,`gameTypeId`,`createdBy`,`createdOn`) values (6,'81 Dojo 2013',0,1,'2012-12-09 08:59:13');

/*Data for the table `gameinfoshogi` */

insert  into `gameinfoshogi`(`id`,`kifuId`) values (194,195),(195,196),(196,197),(197,198),(198,199),(199,200),(200,201),(201,202),(202,203),(203,204),(204,205),(205,206),(206,207);

/*Data for the table `games` */

insert  into `games`(`id`,`name`,`tournamentId`,`gameTypeId`,`date`,`threadId`,`gameInfoId`) values (202,'',52,0,'2012-12-09 09:07:21',220,194),(203,'',52,0,'2012-12-09 09:07:22',221,195),(204,'',52,0,'2012-12-09 09:07:22',222,196),(205,'',52,0,'2012-12-09 09:07:22',223,197),(206,'',52,0,'2012-12-09 09:07:22',224,198),(207,'',52,0,'2012-12-09 09:07:22',225,199),(208,'',52,0,'2012-12-09 09:07:22',226,200),(209,'',52,0,'2012-12-09 09:07:23',227,201),(210,'',52,0,'2012-12-09 09:07:23',228,202),(211,'',52,0,'2012-12-09 09:07:23',229,203),(212,'',53,0,'2012-12-09 09:13:23',230,204),(213,'',53,0,'2012-12-09 09:13:24',231,205),(214,'',53,0,'2012-12-09 09:13:24',232,206);

/*Data for the table `kifu` */

insert  into `kifu`(`id`,`url`,`kifuText`) values (195,'',''),(196,'',''),(197,'',''),(198,'',''),(199,'',''),(200,'',''),(201,'',''),(202,'',''),(203,'',''),(204,'',''),(205,'',''),(206,'',''),(207,'','');

/*Data for the table `organizers` */

/*Data for the table `participants` */

insert  into `participants`(`userId`,`tournamentId`,`note`) values (15,52,''),(16,52,''),(16,53,''),(17,52,''),(18,52,''),(19,52,''),(20,53,''),(21,53,'');

/*Data for the table `players` */

insert  into `players`(`gameId`,`userId`,`gameResultId`) values (202,16,0),(202,15,-1),(203,17,-1),(203,15,-1),(204,17,-1),(204,16,-1),(205,18,-1),(205,15,-1),(206,18,-1),(206,16,-1),(207,18,-1),(207,17,-1),(208,19,-1),(208,15,-1),(209,19,-1),(209,16,-1),(210,19,-1),(210,17,-1),(211,19,-1),(211,18,-1),(212,20,-1),(212,16,-1),(213,21,-1),(213,16,-1),(214,21,-1),(214,20,-1);

/*Data for the table `thread` */

insert  into `thread`(`id`,`name`,`createdBy`,`createdOn`) values (220,'',1,'2012-12-09 09:07:21'),(221,'',1,'2012-12-09 09:07:21'),(222,'',1,'2012-12-09 09:07:22'),(223,'',1,'2012-12-09 09:07:22'),(224,'',1,'2012-12-09 09:07:22'),(225,'',1,'2012-12-09 09:07:22'),(226,'',1,'2012-12-09 09:07:22'),(227,'',1,'2012-12-09 09:07:22'),(228,'',1,'2012-12-09 09:07:23'),(229,'',1,'2012-12-09 09:07:23'),(230,'',1,'2012-12-09 09:13:23'),(231,'',1,'2012-12-09 09:13:24'),(232,'',1,'2012-12-09 09:13:24');

/*Data for the table `tournament_columns` */

insert  into `tournament_columns`(`tournamentId`,`columnId`) values (52,1),(52,2),(52,3),(52,4),(52,5),(52,6),(52,7),(52,8),(52,9),(53,1),(53,2),(53,3),(53,4),(53,5),(53,6),(53,7),(53,8),(53,9),(53,10),(53,11);

/*Data for the table `tournaments` */

insert  into `tournaments`(`id`,`name`,`tournamentTypeId`,`cupId`,`gameTypeId`,`createdBy`,`createdOn`) values (52,'Block A',1,6,'0',1,'2012-12-09 09:07:20'),(53,'Block B',0,6,'0',1,'2012-12-09 09:13:23');

/*Data for the table `userinfo` */

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`middle_name`,`last_name`,`username`,`password`,`email_address`,`roleId`,`createdOn`,`modifiedOn`,`nationalityId`,`timezoneId`) values (1,'admin','','','admin','admin','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',-1,-1),(15,'makoto','','kitayama','makoto','makoto','yeele.ginsho@gmail.com',2,'2012-12-09 09:00:26','2012-12-09 09:00:26',-1,-1),(16,'kunio','','yonenaga','kunio','kunio','kunio.yonenaga@ginsho.com',2,'2012-12-09 09:01:44','2012-12-09 09:01:44',-1,-1),(17,'yoshiharu','','habu','habu','habu','yoshiharu.habu@ginsho.com',2,'2012-12-09 09:02:12','2012-12-09 09:02:12',-1,-1),(18,'toshiyuki','','moriuchi','moriuchi','moriuchi','toshiyuki.moriuchi@ginsho.com',2,'2012-12-09 09:02:43','2012-12-09 09:02:43',-1,-1),(19,'akira','','watanabe','watanabe','watanabe','akira.watanabe@ginsho.com',2,'2012-12-09 09:03:59','2012-12-09 09:03:59',-1,-1),(20,'yasumitsu','','sato','sato','sato','yasumitsu.sato@ginsho.com',2,'2012-12-09 09:12:22','2012-12-09 09:12:22',-1,-1),(21,'makoto','','nakahara','nakahara','nakahara','makoto.nakahara@ginsho.com',2,'2012-12-09 09:12:55','2012-12-09 09:12:55',-1,-1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
