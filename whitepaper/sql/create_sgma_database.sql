/*
Navicat MySQL Data Transfer

Source Server         : mysqlConnection
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : sgma

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-07-08 16:34:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cup`
-- ----------------------------
DROP TABLE IF EXISTS `cup`;
CREATE TABLE `cup` (
`id`  int(11) NOT NULL DEFAULT '-1' ,
`name`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`createdBy`  int(11) NULL DEFAULT '-1' ,
`createdOn`  datetime NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of cup
-- ----------------------------
BEGIN;
INSERT INTO `cup` VALUES ('1', 'Ginsho Cup', '1', '2012-07-01 15:22:01');
COMMIT;

-- ----------------------------
-- Table structure for `emailaccount`
-- ----------------------------
DROP TABLE IF EXISTS `emailaccount`;
CREATE TABLE `emailaccount` (
`id`  int(11) NOT NULL DEFAULT '-1' ,
`address`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`userId`  int(11) NOT NULL DEFAULT '-1' ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of emailaccount
-- ----------------------------
BEGIN;
INSERT INTO `emailaccount` VALUES ('0', 'yeele@ginsho.com', '4'), ('1', 'habu@ginsho.com', '5'), ('2', 'moriuchi@ginsho.com', '6');
COMMIT;

-- ----------------------------
-- Table structure for `game`
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
`id`  int(11) NOT NULL ,
`gameTypeId`  int(11) NULL DEFAULT NULL ,
`originalPlannedDate`  datetime NULL DEFAULT NULL ,
`plannedDate`  datetime NULL DEFAULT NULL ,
`threadId`  int(11) NULL DEFAULT NULL ,
`gameInfoId`  int(11) NULL DEFAULT NULL ,
`gameResultId`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of game
-- ----------------------------
BEGIN;
COMMIT;

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
-- Records of gameinfoshogi
-- ----------------------------
BEGIN;
COMMIT;

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
-- Records of gameresult
-- ----------------------------
BEGIN;
COMMIT;

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
-- Records of gametype
-- ----------------------------
BEGIN;
INSERT INTO `gametype` VALUES ('0', 'Shogi'), ('1', 'Badminton');
COMMIT;

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
-- Records of kifu
-- ----------------------------
BEGIN;
COMMIT;

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
-- Records of thread
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for `tournament`
-- ----------------------------
DROP TABLE IF EXISTS `tournament`;
CREATE TABLE `tournament` (
`id`  int(11) NOT NULL DEFAULT '-1' ,
`name`  varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`tournamentTypeId`  int(11) NULL DEFAULT NULL ,
`cupId`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of tournament
-- ----------------------------
BEGIN;
INSERT INTO `tournament` VALUES ('0', 'A class tournament', '0', '0');
COMMIT;

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
-- Records of tournamenttype
-- ----------------------------
BEGIN;
INSERT INTO `tournamenttype` VALUES ('0', 'Knock-out'), ('1', 'Group');
COMMIT;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`name`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`password`  varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`emailAccountId`  int(11) NOT NULL DEFAULT '-1' ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=9

;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('4', 'yeele', 'yeele', '0'), ('5', 'habu', 'habu', '1'), ('6', 'moriuchi', 'moriuchi', '2');
COMMIT;

-- ----------------------------
-- Auto increment value for `users`
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=9;
