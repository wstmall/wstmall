
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_log_moneys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_moneys`;
CREATE TABLE `wst_log_moneys` (
  `moneyId` bigint(11) NOT NULL AUTO_INCREMENT,
  `targetType` tinyint(4) DEFAULT '0',
  `targetId` int(11) NOT NULL,
  `dataId` int(11) NOT NULL,
  `dataSrc` int(11) NOT NULL,
  `moneyRemark` text NOT NULL,
  `moneyType` tinyint(4) NOT NULL,
  `money` decimal(11,2) NOT NULL,
  `createTime` datetime NOT NULL,
  `transactionId` varchar(100) DEFAULT '0',
  `payType` tinyint(4) NOT NULL DEFAULT '0',
  `dataFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`moneyId`),
  KEY `targetType` (`targetType`,`targetId`),
  KEY `dataSrc` (`dataSrc`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_moneys
-- ----------------------------
