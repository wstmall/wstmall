SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_shops_communitys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_shops_communitys`;
CREATE TABLE `wst_shops_communitys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `communityId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shopId` (`shopId`),
  KEY `communityId` (`communityId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_shops_communitys
-- ----------------------------
