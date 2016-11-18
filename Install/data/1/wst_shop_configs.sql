SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wst_shop_configs`;
CREATE TABLE `wst_shop_configs` (
  `configId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) DEFAULT NULL,
  `shopTitle` varchar(255) DEFAULT NULL,
  `shopKeywords` varchar(255) DEFAULT NULL,
  `shopDesc` varchar(255) DEFAULT NULL,
  `shopBanner` varchar(150) DEFAULT NULL,
  `shopAds` text,
  `shopAdsUrl` text,
  `isDistribut` tinyint(4) DEFAULT '0',
  `distributType` tinyint(4) DEFAULT '1',
  `distributOrderRate` int(11) DEFAULT '0',
  `promoterRate` int(11) DEFAULT '0',
  `buyerRate` int(11) DEFAULT '0',
  PRIMARY KEY (`configId`),
  KEY `shopId` (`shopId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
