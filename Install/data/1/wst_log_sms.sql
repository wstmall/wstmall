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
  `smsCode` varchar(20) DEFAULT NULL,
  `smsIP` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`smsId`),
  KEY `smsPhoneNumber` (`smsPhoneNumber`),
  KEY `smsIP` (`smsIP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
