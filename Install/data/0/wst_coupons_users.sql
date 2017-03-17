
DROP TABLE IF EXISTS `wst_coupons_users`;
CREATE TABLE `wst_coupons_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponId` int(11) DEFAULT '0',
  `userId` int(11) DEFAULT '0',
  `receiveTime` datetime DEFAULT NULL,
  `couponStatus` tinyint(4) DEFAULT '1',
  `dataFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


