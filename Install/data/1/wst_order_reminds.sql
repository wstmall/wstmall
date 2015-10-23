SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_order_reminds`
-- ----------------------------
DROP TABLE IF EXISTS `wst_order_reminds`;
CREATE TABLE `wst_order_reminds` (
  `remindId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `remindType` tinyint(4) NOT NULL DEFAULT '0',
  `userType` tinyint(4) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`remindId`),
  KEY `shopId` (`shopId`,`remindType`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_order_reminds
-- ----------------------------
INSERT INTO `wst_order_reminds` VALUES ('1', '2', '9', '4', '0', '0', '2015-05-19 23:35:49');
INSERT INTO `wst_order_reminds` VALUES ('2', '3', '9', '4', '0', '0', '2015-05-24 15:59:46');
