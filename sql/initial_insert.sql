/*
Navicat MySQL Data Transfer

Source Server         : mysqlConnection
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : sgma

Target Server Type    : MYSQL
Target Server Version : 50099
File Encoding         : 65001

Date: 2012-07-12 11:55:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Records of cups
-- ----------------------------
BEGIN;
INSERT INTO `cups` VALUES ('1', 'Ginsho Cup', '1', '2012-07-01 15:22:01'), ('2', '81 dojo 6th Cup', '1', '2012-07-10 16:28:30');
COMMIT;

-- ----------------------------
-- Records of gameinfoshogi
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Records of gameresult
-- ----------------------------
BEGIN;
INSERT INTO `gameresult` VALUES ('0', 'Won'), ('1', 'Lost'), ('2', 'Draw'), ('3', 'Postoponed');
COMMIT;

-- ----------------------------
-- Records of games
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Records of gametype
-- ----------------------------
BEGIN;
INSERT INTO `gametype` VALUES ('0', 'Shogi'), ('1', 'Badminton');
COMMIT;

-- ----------------------------
-- Records of kifu
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Records of participants
-- ----------------------------
BEGIN;
INSERT INTO `participants` VALUES ('0', '1'), ('0', '2'), ('1', '1'), ('9', '1'), ('9', '2'), ('10', '1');
COMMIT;

-- ----------------------------
-- Records of thread
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Records of tournaments
-- ----------------------------
BEGIN;
INSERT INTO `tournaments` VALUES ('00000000001', 'A block', '0', '2'), ('00000000002', 'B block Knock-down tournament', '0', '2');
COMMIT;

-- ----------------------------
-- Records of tournamenttype
-- ----------------------------
BEGIN;
INSERT INTO `tournamenttype` VALUES ('0', 'Knock-out'), ('1', 'Group');
COMMIT;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('0', 'kunio', 'yonenaga', 'kunio', 'kunio', 'kunio@ginsho.jp', '2012-07-10 12:02:57', '2012-07-10 12:02:57'), ('1', 'yoshiharu', 'habu', 'habu', 'habu', 'habu@ginsho.jp', '2012-07-10 12:02:57', '2012-07-10 12:02:57'), ('2', 'toshiyuki', 'moriuchi', 'moriuchi', 'moriuchi', 'yeele@ginsho.jp', '2012-07-10 12:02:57', '2012-07-10 12:02:57'), ('9', 'kazuki', 'kimura', 'kimura', 'kimura', 'kimura@ginsho.jp', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('10', 'tokyo', 'tokyo', 'tokyo', 'tokyo', 'tokyo@tokyo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('11', 'madoka', 'kitao', 'madoka', 'madoka', 'madoka@ginsho.jp', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;
