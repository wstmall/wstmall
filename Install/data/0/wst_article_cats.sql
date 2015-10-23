/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:48:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_article_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_article_cats`;
CREATE TABLE `wst_article_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NOT NULL,
  `catType` tinyint(4) NOT NULL DEFAULT '0',
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `catName` varchar(20) NOT NULL,
  `catSort` int(11) NOT NULL DEFAULT '0',
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catId`),
  KEY `isShow` (`catType`,`catFlag`,`isShow`) USING BTREE,
  KEY `parentId` (`catFlag`,`parentId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_article_cats
-- ----------------------------
INSERT INTO `wst_article_cats` VALUES ('1', '0', '0', '0', '商城快讯', '0', '1'),
('2', '0', '1', '1', '新手上路', '0', '1'),
('3', '0', '1', '1', '如何付款', '0', '1'),
('4', '0', '1', '1', '配送说明', '0', '1'),
('5', '0', '1', '1', '售后服务', '0', '1'),
('6', '0', '1', '1', '常见问题', '0', '1');
