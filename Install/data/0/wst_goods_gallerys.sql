SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_goods_gallerys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_gallerys`;
CREATE TABLE `wst_goods_gallerys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `goodsImg` varchar(150) NOT NULL,
  `goodsThumbs` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goodsId` (`goodsId`,`shopId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_gallerys
-- ----------------------------
