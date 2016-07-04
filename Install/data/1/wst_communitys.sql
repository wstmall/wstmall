SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_communitys`
-- ----------------------------
DROP TABLE IF EXISTS `wst_communitys`;
CREATE TABLE `wst_communitys` (
  `communityId` int(11) NOT NULL AUTO_INCREMENT,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `areaId3` int(11) NOT NULL,
  `isShow` tinyint(4) NOT NULL DEFAULT '1',
  `isService` tinyint(4) NOT NULL DEFAULT '0',
  `communityName` varchar(80) NOT NULL,
  `communitySort` int(11) NOT NULL DEFAULT '0',
  `communityKey` char(255) NOT NULL,
  `communityFlag` tinyint(4) NOT NULL DEFAULT '1',
  `latitude` char(30) DEFAULT NULL,
  `longitude` char(30) DEFAULT NULL,
  `mapLevel` int(11) DEFAULT '13',
  PRIMARY KEY (`communityId`),
  KEY `isShow` (`isShow`,`communityFlag`),
  KEY `areaId1` (`areaId1`) USING BTREE,
  KEY `areaId2` (`areaId2`),
  KEY `areaId3` (`areaId3`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_communitys
-- ----------------------------
INSERT INTO `wst_communitys` VALUES ('15', '440000', '440100', '440106', '1', '1', '五山岑村社区', '1', '', '1', NULL, NULL, '13'),
 ('16', '440000', '440100', '440106', '1', '1', '华南农业大学社区', '2', '', '1', NULL, NULL, '13'),
 ('17', '440000', '440100', '440106', '1', '1', '华南理工大学社区', '3', '', '1', NULL, NULL, '13'),
 ('18', '440000', '440100', '440106', '1', '1', '暨南大学社区', '4', '', '1', NULL, NULL, '13'),
 ('19', '440000', '440100', '440106', '1', '1', '华南师范大学社区', '5', '', '1', NULL, NULL, '13'),
 ('20', '440000', '440100', '440106', '1', '1', '石牌桥社区', '8', '', '1', NULL, NULL, '13'),
 ('21', '440000', '440100', '440106', '1', '1', '岗顶社区', '6', '', '1', NULL, NULL, '13'),
 ('22', '440000', '440100', '440106', '1', '1', '五羊新村', '6', '', '1', NULL, NULL, '13'),
 ('23', '440000', '440100', '440106', '1', '1', '天河体育中心', '7', '', '1', NULL, NULL, '13');
