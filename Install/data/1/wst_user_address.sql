SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_user_address`
-- ----------------------------
DROP TABLE IF EXISTS `wst_user_address`;
CREATE TABLE `wst_user_address` (
  `addressId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPhone` varchar(20) DEFAULT NULL,
  `userTel` varchar(20) DEFAULT NULL,
  `areaId1` int(11) NOT NULL DEFAULT '0',
  `areaId2` int(11) NOT NULL DEFAULT '0',
  `areaId3` int(11) NOT NULL DEFAULT '0',
  `communityId` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `postCode` char(6) NOT NULL,
  `isDefault` tinyint(4) NOT NULL DEFAULT '0',
  `addressFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`addressId`),
  KEY `userId` (`userId`,`addressFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_user_address
-- ----------------------------
INSERT INTO `wst_user_address` VALUES ('1', '9', '马生', null, '020-46787622', '440000', '440100', '440106', '15', '红花岗', '512000', '0', '1', '2015-05-19 23:28:38'),
('2', '9', '马生', null, '1591867199', '440000', '440100', '440106', '17', '桑德菲杰卡拉斯的减肥', '345987', '1', '1', '2015-05-19 23:55:11');
