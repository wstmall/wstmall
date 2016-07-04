SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_goods_relateds`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_relateds`;
CREATE TABLE `wst_goods_relateds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NOT NULL,
  `relatedGoodsId` int(11) NOT NULL,
  `relatedType` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_relateds
-- ----------------------------
