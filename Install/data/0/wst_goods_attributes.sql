SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_goods_attributes`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_attributes`;
CREATE TABLE `wst_goods_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `goodsId` int(11) NOT NULL,
  `attrId` int(11) NOT NULL,
  `attrVal` text NOT NULL,
  `attrPrice` decimal(11,2) DEFAULT '0.00',
  `attrStock` int(11) DEFAULT '0',
  `isRecomm` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `goodsId` (`goodsId`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_attributes
-- ----------------------------
