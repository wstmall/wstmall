
DROP TABLE IF EXISTS `wst_coupons`;
CREATE TABLE `wst_coupons` (
  `couponId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) DEFAULT '0',
  `couponName` varchar(200) DEFAULT NULL,
  `couponType` tinyint(4) DEFAULT '1',
  `couponMoney` int(11) DEFAULT '0',
  `spendMoney` int(11) DEFAULT '0',
  `couponDes` text,
  `sendNum` int(11) DEFAULT '0',
  `receiveNum` int(11) DEFAULT '0',
  `sendStartTime` date DEFAULT NULL,
  `sendEndTime` date DEFAULT NULL,
  `validStartTime` date DEFAULT NULL,
  `validEndTime` date DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `dataFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`couponId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
