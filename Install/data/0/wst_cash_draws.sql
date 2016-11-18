
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_cash_draws`
-- ----------------------------
DROP TABLE IF EXISTS `wst_cash_draws`;
CREATE TABLE `wst_cash_draws` (
  `cashId` int(11) NOT NULL AUTO_INCREMENT,
  `targetType` tinyint(4) NOT NULL DEFAULT '0',
  `targetId` int(11) NOT NULL,
  `money` float(11,2) NOT NULL DEFAULT '0.00',
  `accType` tinyint(4) DEFAULT '0',
  `accTarget` varchar(255) DEFAULT '0',
  `accNo` varchar(30) DEFAULT NULL,
  `accUser` varchar(100) DEFAULT NULL,
  `cashSatus` tinyint(4) NOT NULL DEFAULT '0',
  `cashRemarks` varchar(255) NOT NULL,
  `createTime` datetime NOT NULL,
  `handleTime` datetime DEFAULT NULL,
  `cashConfigId` int(11) DEFAULT NULL,
  `areaId2` int(11) DEFAULT '0',
  PRIMARY KEY (`cashId`),
  KEY `targetType` (`targetType`),
  KEY `targetType_2` (`targetType`,`cashSatus`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_cash_draws
-- ----------------------------
