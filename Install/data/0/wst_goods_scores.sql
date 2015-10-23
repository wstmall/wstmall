/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:46:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_goods_scores`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_scores`;
CREATE TABLE `wst_goods_scores` (
  `scoreId` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) DEFAULT NULL,
  `shopId` int(11) DEFAULT NULL,
  `totalScore` int(11) DEFAULT '0',
  `totalUsers` int(11) DEFAULT '0',
  `goodsScore` int(11) DEFAULT '0',
  `goodsUsers` int(11) DEFAULT '0',
  `serviceScore` int(11) DEFAULT '0',
  `serviceUsers` int(11) DEFAULT '0',
  `timeScore` int(11) DEFAULT '0',
  `timeUsers` int(11) DEFAULT '0',
  PRIMARY KEY (`scoreId`),
  KEY `goodsId` (`goodsId`,`shopId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_scores
-- ----------------------------
