/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:46:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_messages`
-- ----------------------------
DROP TABLE IF EXISTS `wst_messages`;
CREATE TABLE `wst_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgType` tinyint(4) DEFAULT '0',
  `sendUserId` int(11) DEFAULT NULL,
  `receiveUserId` int(11) DEFAULT NULL,
  `msgContent` text,
  `createTime` datetime DEFAULT NULL,
  `msgStatus` tinyint(4) DEFAULT '0',
  `msgFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `receiveUserId` (`receiveUserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_messages
-- ----------------------------
