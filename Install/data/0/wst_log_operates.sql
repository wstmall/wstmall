/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:46:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_log_operates`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_operates`;
CREATE TABLE `wst_log_operates` (
  `operateId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `operateTime` datetime NOT NULL,
  `module` varchar(20) NOT NULL,
  `operateURI` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`operateId`),
  KEY `operateTime` (`operateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_operates
-- ----------------------------
