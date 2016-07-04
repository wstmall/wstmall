SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_orderids`
-- ----------------------------
DROP TABLE IF EXISTS `wst_orderids`;
CREATE TABLE `wst_orderids` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `rnd` float(16,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_orderids
-- ----------------------------
