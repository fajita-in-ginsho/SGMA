/*
Navicat MySQL Data Transfer

Source Server         : mysqlConnection
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : sgma

Target Server Type    : MYSQL
Target Server Version : 50099
File Encoding         : 65001

Date: 2012-07-12 11:54:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cups`
-- ----------------------------
DROP TABLE IF EXISTS `cups`;
CREATE TABLE `cups` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`name`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`createdBy`  int(11) NULL DEFAULT '-1' ,
`createdOn`  datetime NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
/*!50003 AUTO_INCREMENT=3 */

;

-- ----------------------------
-- Table structure for `gameinfoshogi`
-- ----------------------------
DROP TABLE IF EXISTS `gameinfoshogi`;
CREATE TABLE `gameinfoshogi` (
`id`  int(11) NOT NULL ,
`gameTypeId`  int(11) NULL DEFAULT NULL ,
`playerId1`  int(11) NULL DEFAULT NULL ,
`playerId2`  int(11) NULL DEFAULT NULL ,
`kifuId`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Table structure for `gameresult`
-- ----------------------------
DROP TABLE IF EXISTS `gameresult`;
CREATE TABLE `gameresult` (
`id`  int(11) NOT NULL ,
`description`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Table structure for `games`
-- ----------------------------
DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`gameTypeId`  int(11) NOT NULL ,
`date`  datetime NOT NULL ,
`threadId`  int(11) NOT NULL ,
`gameInfoId`  int(11) NOT NULL ,
`gameResultId`  int(11) NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
/*!50003 AUTO_INCREMENT=1 */

;

-- ----------------------------
-- Table structure for `gametype`
-- ----------------------------
DROP TABLE IF EXISTS `gametype`;
CREATE TABLE `gametype` (
`id`  int(11) NOT NULL ,
`name`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Table structure for `kifu`
-- ----------------------------
DROP TABLE IF EXISTS `kifu`;
CREATE TABLE `kifu` (
`id`  int(11) NOT NULL ,
`type`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`savedUrl`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`kifuText`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Table structure for `participants`
-- ----------------------------
DROP TABLE IF EXISTS `participants`;
CREATE TABLE `participants` (
`userId`  int(11) NOT NULL ,
`tornamentId`  int(11) NOT NULL ,
PRIMARY KEY (`userId`, `tornamentId`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Table structure for `thread`
-- ----------------------------
DROP TABLE IF EXISTS `thread`;
CREATE TABLE `thread` (
`id`  int(11) NOT NULL ,
`createdBy`  int(11) NULL DEFAULT NULL ,
`createdOn`  datetime NULL DEFAULT NULL ,
`message`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Table structure for `tournaments`
-- ----------------------------
DROP TABLE IF EXISTS `tournaments`;
CREATE TABLE `tournaments` (
`id`  int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
`name`  varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`tournamentTypeId`  int(11) NULL DEFAULT NULL ,
`cupId`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
/*!50003 AUTO_INCREMENT=3 */

;

-- ----------------------------
-- Table structure for `tournamenttype`
-- ----------------------------
DROP TABLE IF EXISTS `tournamenttype`;
CREATE TABLE `tournamenttype` (
`id`  int(11) NOT NULL DEFAULT '-1' ,
`name`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`first_name`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`last_name`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`username`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`password`  varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`email_address`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '-1' ,
`createdOn`  datetime NOT NULL ,
`modifiedOn`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
/*!50003 AUTO_INCREMENT=12 */

;

-- ----------------------------
-- Auto increment value for `cups`
-- ----------------------------
ALTER TABLE `cups` AUTO_INCREMENT=3;

-- ----------------------------
-- Auto increment value for `games`
-- ----------------------------
ALTER TABLE `games` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for `tournaments`
-- ----------------------------
ALTER TABLE `tournaments` AUTO_INCREMENT=3;

-- ----------------------------
-- Auto increment value for `users`
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=12;
