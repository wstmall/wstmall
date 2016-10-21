
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `wst_goods_packages`;
CREATE TABLE `wst_goods_packages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `packageId` int(11) DEFAULT '0',
  `goodsId` int(11) DEFAULT '0',
  `diffPrice` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

