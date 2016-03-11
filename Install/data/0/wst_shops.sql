SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_shops`
-- ----------------------------
DROP TABLE IF EXISTS `wst_shops`;
CREATE TABLE `wst_shops` (
  `shopId` int(11) NOT NULL AUTO_INCREMENT,
  `shopSn` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `goodsCatId1` int(11) NOT NULL,
  `goodsCatId2` int(11) DEFAULT NULL,
  `goodsCatId3` int(11) DEFAULT NULL,
  `isSelf` tinyint(4) NOT NULL DEFAULT '0',
  `shopName` varchar(100) NOT NULL,
  `shopCompany` varchar(255) NOT NULL,
  `shopImg` varchar(150) NOT NULL,
  `shopTel` varchar(20) DEFAULT NULL,
  `shopAddress` varchar(255) NOT NULL,
  `avgeCostMoney` decimal(11,2) DEFAULT '0.00',
  `deliveryStartMoney` decimal(11,2) DEFAULT '0.00',
  `deliveryMoney` decimal(11,2) DEFAULT '0.00',
  `deliveryFreeMoney` decimal(11,2) DEFAULT '0.00',
  `deliveryCostTime` int(11) NOT NULL DEFAULT '0',
  `deliveryTime` varchar(255) NOT NULL,
  `deliveryType` tinyint(4) NOT NULL DEFAULT '0',
  `bankId` int(11) NOT NULL,
  `bankNo` varchar(20) NOT NULL,
  `isInvoice` tinyint(4) NOT NULL DEFAULT '0',
  `invoiceRemarks` varchar(255) DEFAULT NULL,
  `serviceStartTime` float(11,1) NOT NULL,
  `serviceEndTime` float(11,1) NOT NULL,
  `shopStatus` tinyint(4) NOT NULL DEFAULT '0',
  `statusRemarks` varchar(255) DEFAULT NULL,
  `shopAtive` tinyint(4) NOT NULL DEFAULT '1',
  `shopFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  `latitude` char(30) DEFAULT '0',
  `longitude` char(30) DEFAULT '0',
  `mapLevel` int(11) DEFAULT '13',
  `qqNo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`shopId`),
  KEY `areaId1` (`areaId2`) USING BTREE,
  KEY `shopStatus` (`shopStatus`,`shopFlag`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_shops
-- ----------------------------
