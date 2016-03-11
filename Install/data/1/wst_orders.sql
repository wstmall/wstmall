SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_orders`
-- ----------------------------
DROP TABLE IF EXISTS `wst_orders`;
CREATE TABLE `wst_orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(20) NOT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `orderStatus` tinyint(4) NOT NULL DEFAULT '-2',
  `totalMoney` decimal(11,2) NOT NULL DEFAULT '0.00',
  `deliverMoney` decimal(11,2) NOT NULL DEFAULT '0.00',
  `payType` tinyint(4) NOT NULL DEFAULT '0',
  `isSelf` tinyint(4) NOT NULL DEFAULT '0',
  `isPay` tinyint(4) NOT NULL DEFAULT '0',
  `deliverType` tinyint(4) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `communityId` int(11) NOT NULL,
  `userAddress` varchar(255) NOT NULL,
  `userTel` varchar(20) DEFAULT NULL,
  `userPhone` char(11) DEFAULT NULL,
  `userPostCode` char(6) NOT NULL,
  `orderScore` int(11) NOT NULL DEFAULT '0',
  `isInvoice` tinyint(4) NOT NULL DEFAULT '0',
  `invoiceClient` varchar(255) DEFAULT NULL,
  `orderRemarks` varchar(255) DEFAULT NULL,
  `requireTime` datetime NOT NULL,
  `isAppraises` tinyint(4) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL,
  `isClosed` tinyint(4) NOT NULL DEFAULT '0',
  `isRefund` tinyint(4) NOT NULL DEFAULT '0',
  `refundRemark` varchar(255) DEFAULT NULL,
  `orderunique` varchar(20) NOT NULL,
  `orderSrc` tinyint(4) NOT NULL DEFAULT '0',
  `orderFlag` tinyint(4) NOT NULL DEFAULT '1',
  `needPay` decimal(11,2) DEFAULT '0.00',
  `tradeNo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `shopId` (`shopId`,`orderFlag`),
  KEY `userId` (`userId`,`orderFlag`),
  KEY `isRefund` (`isRefund`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_orders
-- ----------------------------
INSERT INTO `wst_orders` VALUES ('4', '1000000013', '440000', '440100', '440106', '4', '4', '72.00', '0.00', '0', '0', '0', '1', '9', '马生', '17', '广州市 天河区 华南理工大学社区 桑德菲杰卡拉斯的减肥', '1591867199', null, '', '72', '0', '', '