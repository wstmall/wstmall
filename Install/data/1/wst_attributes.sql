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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_attributes
-- ----------------------------
INSERT INTO `wst_attributes` VALUES ('1', '4', '1', '等级', '0', '1', null, '1', '1', '2015-10-12 13:56:13'),
('2', '4', '1', '产地', '2', '0', '国外,山东,四川,云南,广西,广东', '1', '2', '2015-10-12 13:56:13'),
('3', '4', '1', '营养价值', '0', '0', null, '1', '3', '2015-10-12 13:56:13'),
('4', '4', '2', '等级', '0', '1', null, '1', '1', '2015-10-12 13:57:49'),
('5', '4', '2', '产地', '2', '0', '美国,英国,法国,澳大利亚,中国,台湾', '1', '2', '2015-10-12 13:57:49'),
('6', '4', '2', '烹饪方式', '1', '0', '生食,蒸煮,烧烤,爆炒', '1', '3', '2015-10-12 13:57:49'),
('7', '4', '2', '营养价值', '0', '0', null, '1', '4', '2015-10-12 13:57:49');
