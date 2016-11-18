
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_distribut_moneys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_distribut_moneys`;
CREATE TABLE `wst_distribut_moneys` (
  `moneyId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) DEFAULT '0',
  `orderId` int(11) DEFAULT '0',
  `userId` int(11) DEFAULT '0',
  `promoterId` int(11) DEFAULT '0',
  `buyerId` int(11) DEFAULT '0',
  `moneyRemark` varchar(500) DEFAULT NULL,
  `distributType` tinyint(4) DEFAULT '0',
  `dataId` int(11) DEFAULT '0',
  `money` decimal(11,2) DEFAULT '0.00',
  `distributMoney` decimal(11,2) DEFAULT '0.00',
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`moneyId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_distribut_moneys
-- ----------------------------
