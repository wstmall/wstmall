SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_attribute_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wst_attribute_cats`;
CREATE TABLE `wst_attribute_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `catFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`catId`),
  KEY `shopId` (`shopId`,`catFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_attribute_cats
-- ----------------------------
INSERT INTO `wst_attribute_cats` VALUES ('1', '4', '水果', '1', '2015-10-12 13:54:29'),
('2', '4', '海产', '1', '2015-10-12 13:54:38');
