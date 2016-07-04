SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_attributes`
-- ----------------------------
DROP TABLE IF EXISTS `wst_attributes`;
CREATE TABLE `wst_attributes` (
  `attrId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `attrName` varchar(255) NOT NULL,
  `attrType` tinyint(4) NOT NULL DEFAULT '0',
  `isPriceAttr` tinyint(4) DEFAULT '0',
  `attrContent` text,
  `attrFlag` tinyint(4) NOT NULL DEFAULT '1',
  `attrSort` int(11) DEFAULT '0',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`attrId`),
  KEY `shopId` (`shopId`,`catId`,`attrFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_attributes
-- ----------------------------
