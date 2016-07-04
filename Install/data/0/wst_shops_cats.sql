SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_shops_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_shops_cats`;
CREATE TABLE `wst_shops_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `parentId` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `catName` varchar(100) NOT NULL,
  `catSort` int(11) NOT NULL DEFAULT '0',
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catId`),
  KEY `parentId` (`isShow`,`catFlag`) USING BTREE,
  KEY `shopId` (`shopId`,`catFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_shops_cats
-- ----------------------------
