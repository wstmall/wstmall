SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wst_order_settlements`;
CREATE TABLE `wst_order_settlements` (
  `settlementId` int(11) NOT NULL AUTO_INCREMENT,
  `settlementNo` varchar(12) DEFAULT NULL,
  `settlementType` tinyint(4) NOT NULL DEFAULT '0',
  `shopId` int(11) NOT NULL,
  `accName` varchar(50) DEFAULT NULL,
  `accNo` varchar(30) NOT NULL,
  `accUser` varchar(100) NOT NULL,
  `orderMoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `settlementMoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `poundageMoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createTime` datetime NOT NULL,
  `isFinish` tinyint(4) NOT NULL DEFAULT '0',
  `finishTime` datetime DEFAULT NULL,
  `remarks` text,
  PRIMARY KEY (`settlementId`),
  KEY `shopId` (`shopId`),
  KEY `isFinish` (`isFinish`),
  KEY `settlementNo` (`settlementNo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
