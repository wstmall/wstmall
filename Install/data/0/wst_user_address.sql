/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:47:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_user_address`
-- ----------------------------
DROP TABLE IF EXISTS `wst_user_address`;
CREATE TABLE `wst_user_address` (
  `addressId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPhone` varchar(20) DEFAULT NULL,
  `userTel` varchar(20) DEFAULT NULL,
  `areaId1` int(11) NOT NULL DEFAULT '0',
  `areaId2` int(11) NOT NULL DEFAULT '0',
  `areaId3` int(11) NOT NULL DEFAULT '0',
  `communityId` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `postCode` char(6) NOT NULL,
  `isDefault` tinyint(4) NOT NULL DEFAULT '0',
  `addressFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`addressId`),
  KEY `userId` (`userId`,`addressFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_user_address
-- ----------------------------
