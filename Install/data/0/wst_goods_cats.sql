SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_goods_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_goods_cats`;
CREATE TABLE `wst_goods_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `catName` varchar(20) NOT NULL,
  `priceSection` text,
  `catSort` int(11) NOT NULL DEFAULT '0',
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  `isFloor` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catId`),
  KEY `parentId` (`parentId`,`isShow`,`catFlag`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_goods_cats
-- ----------------------------
