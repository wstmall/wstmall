
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_cash_configs`
-- ----------------------------
DROP TABLE IF EXISTS `wst_cash_configs`;
CREATE TABLE `wst_cash_configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `accType` tinyint(4) NOT NULL,
  `accTargetId` int(130) DEFAULT '0',
  `accNo` varchar(30) NOT NULL,
  `accUser` varchar(100) NOT NULL,
  `createTime` datetime NOT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `areaId2` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `targetType` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
