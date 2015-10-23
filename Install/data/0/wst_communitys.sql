/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:45:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_communitys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_communitys`;
CREATE TABLE `wst_communitys` (
  `communityId` int(11) NOT NULL AUTO_INCREMENT,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `isService` tinyint(4) NOT NULL DEFAULT '0',
  `communityName` varchar(80) NOT NULL,
  `communitySort` int(11) NOT NULL DEFAULT '0',
  `communityKey` char(255) NOT NULL,
  `communityFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`communityId`),
  KEY `isShow` (`isShow`,`communityFlag`),
  KEY `areaId1` (`areaId1`) USING BTREE,
  KEY `areaId2` (`areaId2`),
  KEY `areaId3` (`areaId3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_communitys
-- ----------------------------
