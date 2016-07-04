SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_goods_cat_brands`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_cat_brands`;
CREATE TABLE `wst_goods_cat_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) DEFAULT NULL,
  `brandId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catId` (`catId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_cat_brands
-- ----------------------------
