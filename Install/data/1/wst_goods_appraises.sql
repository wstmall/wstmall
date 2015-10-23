SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_goods_appraises`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_appraises`;
CREATE TABLE `wst_goods_appraises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `goodsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `goodsScore` int(11) NOT NULL DEFAULT '0',
  `serviceScore` int(11) NOT NULL DEFAULT '0',
  `timeScore` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `orderId` (`orderId`,`goodsId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_appraises
-- ----------------------------
