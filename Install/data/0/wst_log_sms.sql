/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : wstmall

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-03 12:46:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_log_sms`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_sms`;
CREATE TABLE `wst_log_sms` (
  `smsId` int(11) NOT NULL AUTO_INCREMENT,
  `smsSrc` tinyint(4) DEFAULT '0',
  `smsUserId` int(11) DEFAULT '0',
  `smsContent` varchar(255) DEFAULT NULL,
  `smsPhoneNumber` varchar(11) DEFAULT NULL,
  `smsReturnCode` varchar(255) DEFAULT NULL,
  `smsFunc` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`smsId`),
  KEY `logSrcType` (`smsSrc`,`smsPhoneNumber`),
  KEY `createTime` (`createTime`),
  KEY `logFunc` (`smsFunc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_sms
-- ----------------------------
