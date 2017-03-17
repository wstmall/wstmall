
-- ----------------------------
DROP TABLE IF EXISTS `wst_styles`;
CREATE TABLE `wst_styles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `styleSys` varchar(20) DEFAULT NULL,
  `styleName` varchar(255) NOT NULL,
  `styleAuthor` varchar(255) DEFAULT NULL,
  `styleShopSite` varchar(11) DEFAULT NULL,
  `styleShopId` int(11) DEFAULT '0',
  `stylePath` varchar(255) NOT NULL,
  `isUse` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `isUse` (`isUse`,`styleSys`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO `wst_styles` VALUES ('1', 'Home', '默认模板', 'WSTMall开发组', '', '1', 'default', '1');
