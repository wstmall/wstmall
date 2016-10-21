
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `wst_packages`;
CREATE TABLE `wst_packages` (
  `packageId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) DEFAULT '0',
  `goodsId` int(11) DEFAULT '0',
  `packageName` varchar(100) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`packageId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

