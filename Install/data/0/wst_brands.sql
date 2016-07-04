SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_brands`
-- ----------------------------
DROP TABLE IF EXISTS `wst_brands`;
CREATE TABLE `wst_brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) NOT NULL,
  `brandIco` varchar(150) NOT NULL,
  `brandDesc` text,
  `createTime` datetime NOT NULL,
  `brandFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`brandId`),
  KEY `brandFlag` (`brandFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_brands
-- ----------------------------
