SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_ads`
-- ----------------------------
DROP TABLE IF EXISTS `wst_ads`;
CREATE TABLE `wst_ads` (
  `adId` int(11) NOT NULL AUTO_INCREMENT,
  `adPositionId` int(11) DEFAULT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `adType` tinyint(4) NOT NULL DEFAULT '0',
  `adFile` varchar(150) NOT NULL,
  `adName` varchar(100) NOT NULL,
  `adURL` varchar(150) NOT NULL,
  `adStartDate` date NOT NULL,
  `adEndDate` date NOT NULL,
  `adSort` int(11) NOT NULL DEFAULT '0',
  `adClickNum` int(11) DEFAULT '0',
  PRIMARY KEY (`adId`),
  KEY `adPositionId` (`adPositionId`,`areaId1`,`areaId2`,`adStartDate`,`adEndDate`),
  KEY `adPositionId_2` (`adPositionId`,`areaId1`,`areaId2`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_ads
-- ----------------------------
INSERT INTO `wst_ads` VALUES ('11', '48', '0', '0', '0', 'Upload/ads/2015-05/554c1350baef2.png', '2f', '', '2015-05-08', '2016-09-02', '2', '0'),
 ('12', '47', '0', '0', '0', 'Upload/ads/2015-05/554c14217b5c6.png', '1f', '', '2015-05-08', '2016-11-16', '0', '0'),
 ('13', '49', '0', '0', '0', 'Upload/ads/2015-05/554c145e9e8bb.png', '3f', '', '2015-05-08', '2016-10-12', '0', '0'),
 ('14', '50', '0', '0', '0', 'Upload/ads/2015-05/554c14bd26cb0.png', '4f', '', '2015-05-08', '2016-09-08', '0', '0'),
 ('15', '51', '0', '0', '0', 'Upload/ads/2015-05/554c1501603bb.png', '5f', '', '2015-05-08', '2016-10-31', '0', '0'),
 ('16', '52', '0', '0', '0', 'Upload/ads/2015-05/554c15429d5ee.png', '6f', '', '2015-05-08', '2016-11-10', '0', '0'),
 ('17', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c173b5c57e.jpg', '1', '', '2015-05-08', '2016-07-31', '1', '0'),
 ('18', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c176b931e8.jpg', '2', '', '2015-05-08', '2016-07-31', '2', '0'),
 ('19', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c1785e590c.jpg', '3', '', '2015-05-08', '2017-01-30', '3', '7'),
 ('20', '-1', '0', '0', '0', 'Upload/ads/2015-05/554c179b4a408.jpg', '4', '', '2015-05-08', '2017-01-04', '4', '0');
