SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wst_cart`;
CREATE TABLE `wst_cart` (
  `cartId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `isCheck` tinyint(4) NOT NULL DEFAULT '1',
  `goodsId` int(11) NOT NULL DEFAULT '0',
  `goodsAttrId` int(11) NOT NULL DEFAULT '0',
  `goodsCnt` int(11) NOT NULL DEFAULT '0',
  `packageId` int(11) NOT NULL DEFAULT '0',
  `batchNo` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cartId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

