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
  `totalMoney` float(11,1) NOT NULL,
  `deliverMoney` float(11,1) NOT NULL,
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
  `needPay` float(11,1) DEFAULT '0.0',
  `tradeNo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `shopId` (`shopId`,`orderFlag`),
  KEY `userId` (`userId`,`orderFlag`),
  KEY `isRefund` (`isRefund`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_orders
-- ----------------------------
INSERT INTO `wst_orders` VALUES ('1', '11', '440000', '440100', '440106', '4', '-2', '108.0', '0.0', '1', '1', '0', '0', '9', '马生', '15', '红花岗', '020-46787622', null, '512000', '108', '0', '', '111', '2015-05-21 00:00:00', '0', '2015-05-19 23:29:11', '0', '0', null, '1432049292155', '0', '1', '0.0'),
 ('2', '22', '440000', '440100', '440106', '4', '-4', '36.0', '0.0', '0', '0', '0', '0', '9', '马生', '15', '红花岗', '020-46787622', null, '512000', '36', '1', '江门移动', '757', '2015-05-20 04:00:00', '0', '2015-05-19 23:35:48', '0', '0', null, '1432049687902', '0', '1', '0.0'),
 ('3', '33', '440000', '440100', '440106', '4', '0', '144.0', '0.0', '0', '0', '0', '0', '9', '马生', '15', '红花岗', '020-46787622', null, '512000', '144', '0', '', '', '2015-05-24 17:00:00', '0', '2015-05-24 15:59:46', '0', '0', null, '1432454386374', '0', '1', '0.0');
