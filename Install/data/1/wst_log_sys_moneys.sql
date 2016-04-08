
DROP TABLE IF EXISTS `wst_log_sys_moneys`;
CREATE TABLE `wst_log_sys_moneys` (
  `moneyId` int(11) NOT NULL AUTO_INCREMENT,
  `targetType` tinyint(4) NOT NULL DEFAULT '0',
  `targetId` int(11) NOT NULL DEFAULT '0',
  `dataSrc` int(11) NOT NULL DEFAULT '0',
  `dataId` int(11) NOT NULL DEFAULT '0',
  `moneyRemark` text,
  `moneyType` tinyint(4) NOT NULL DEFAULT '0',
  `money` decimal(11,2) NOT NULL DEFAULT '0.00',
  `createTime` datetime DEFAULT NULL,
  `dataFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`moneyId`),
  KEY `targetType` (`targetType`,`targetId`),
  KEY `dataSrc` (`dataSrc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

